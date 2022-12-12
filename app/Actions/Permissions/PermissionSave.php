<?php

namespace App\Actions\Permissions;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\WithAttributes;
use Spatie\Permission\Models\Permission;

class PermissionSave
{
    use AsAction;
    use withAttributes;


    /**
     * @throws ValidationException
     */
    public function handle(Permission $permission):array
    {
      $permission= PermissionSanitizeData::run($permission);
        $data = $this->set('permission', $permission)->fill($permission->toArray());
        Validator::make(
            $data->attributes,
            PermissionValidation::make()->rules($this->permission->id),
            PermissionValidation::make()->messages(),
        )->validate();
        try {
            $success = DB::transaction(function () use ($permission) {
                $permission->save();
                return [true, $permission];
            });
        } catch (\Exception $e) {
            DB::rollback();
            return [false, $e->getMessage()];
        }
        return $success;
    }



}
