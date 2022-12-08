<?php

namespace App\Actions\Users;

use App\Traits\Data;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Permission;

class UserModels
{
    use AsAction;

    public function handle(User $user): array
    {
        $models = Data::getAvailableModels();
        $include=['Role','Permission'];
        $exclude = ['Admin', 'Membership', 'Team', 'TeamInvitation'];
        $array = [];
        foreach (array_diff(array_merge($include,$models),$exclude) as $model) {
            $array[$model] = $model;
        }
        $models = $array;
        if (auth()->guard('admin')->check()) {
            if (count($models) === 1) $user['model'] = array_key_first($models);

        } elseif (auth()->guard('admin')->check() && auth()->user()->hasRole('super admin')) {
            if (count($models) === 1) $user['model'] = array_key_first($models);
        } else {
            $exclude = ['Admin', 'Membership', 'Team', 'TeamInvitation'];
            $models = array_diff($models, $exclude);
            if (count($models) === 1) $user['model'] = array_key_first($models);
        }

        return $models;
    }


}
