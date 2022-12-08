<?php

namespace App\Actions\Users;

use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Permission;

class UserGuards
{
    use AsAction;

    public function handle(User $user): array
    {
        if (auth()->guard('admin')->check() && auth()->user()->hasRole('admin')) {
            $guards = ['web'=>'User'];
            if (count($guards) === 1) $user['guard_name'] = array_key_first($guards);

        } elseif(auth()->guard('admin')->check() && auth()->user()->hasRole('super admin')) {
            $guards = ['admin'=>'Admin'];
            if (count($guards) === 1) $user['guard_name'] = array_key_first($guards);
        }else{
            $guards = ['web'=>'User'];
            if (count($guards) === 1) $user['guard_name'] = array_key_first($guards);
        }
        return $guards;
    }


}
