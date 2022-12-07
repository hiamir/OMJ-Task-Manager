<?php

namespace App\Actions\Permissions;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\WithAttributes;
use Spatie\Permission\Models\Permission;

class PermissionDelete
{
    use AsAction;
    use withAttributes;


    public function handle(Permission $role):array
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
