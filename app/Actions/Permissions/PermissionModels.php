<?php

namespace App\Actions\Permissions;

use App\Traits\Data;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Permission;

class PermissionModels
{
    use AsAction;

    public function handle(Permission $permission): array
    {
        $models = Data::getAvailableModels();

        if (auth()->guard('admin')->check() ) {
            $exclude = ['Admin', 'Membership', 'Team', 'TeamInvitation'];
            $models = array_diff($models, $exclude);
            if (count($models) === 1) $permission['model'] = array_key_first($models);

        } elseif (auth()->guard('admin')->check() && auth()->user()->hasRole('super admin')) {
            if (count($models) === 1) $permission['model'] = array_key_first($models);
        } else {
            $exclude = ['Admin', 'Membership', 'Team', 'TeamInvitation'];
            $models = array_diff($models, $exclude);
            if (count($models) === 1) $permission['model'] = array_key_first($models);
        }
        return $models;
    }


}
