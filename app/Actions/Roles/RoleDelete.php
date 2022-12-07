<?php

namespace App\Actions\Roles;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\WithAttributes;
use Spatie\Permission\Models\Role;

class RoleDelete
{
    use AsAction;
    use withAttributes;


    public function handle(Role $role):array
    {
        try {
            $success = DB::transaction(function () use ($role) {
                $role->delete();
                return [true, $role];
            });
        } catch (\Exception $e) {
            DB::rollback();
            return [false, $e->getMessage()];
        }
        return $success;
    }


}
