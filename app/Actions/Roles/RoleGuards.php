<?php

namespace App\Actions\Roles;

use App\Models\Menu;
use App\Traits\Data;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\WithAttributes;
use Spatie\Permission\Models\Role;

class RoleGuards
{
    use AsAction;

    public function handle(Role $role): array
    {
        if (auth()->guard('admin')->check() && auth()->user()->hasRole('admin')) {
            $guards = ['web'=>'User'];
            if (count($guards) === 1) $role['guard_name'] = array_key_first($guards);

        } elseif(auth()->guard('admin')->check() && auth()->user()->hasRole('super admin')) {
            $guards = ['admin'=>'Admin'];
            if (count($guards) === 1) $role['guard_name'] = array_key_first($guards);
        }else{
            $guards = ['web'=>'User'];
            if (count($guards) === 1) $role['guard_name'] = array_key_first($guards);
        }
        return $guards;
    }


}
