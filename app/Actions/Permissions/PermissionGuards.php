<?php

namespace App\Actions\Permissions;

use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Permission;

class PermissionGuards
{
    use AsAction;

    public function handle(Permission $permission): array
    {
        if (auth()->guard('admin')->check() && auth()->user()->hasRole('admin')) {
            $guards = ['web'=>'User'];
            if (count($guards) === 1) $permission['guard_name'] = array_key_first($guards);

        } elseif(auth()->guard('admin')->check() && auth()->user()->hasRole('super admin')) {
            $guards = ['admin'=>'Admin'];
            if (count($guards) === 1) $permission['guard_name'] = array_key_first($guards);
        }else{
            $guards = ['web'=>'User'];
            if (count($guards) === 1) $permission['guard_name'] = array_key_first($guards);
        }
        return $guards;
    }


}
