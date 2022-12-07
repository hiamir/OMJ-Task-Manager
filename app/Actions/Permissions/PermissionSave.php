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
    public function handle(Permission $role):array
    {
      $role= PermissionSanitizeData::run($role);
        $data = $this->set('role', $role)->fill($role->toArray());
        Validator::make(
            $data->attributes,
            PermissionValidation::make()->rules($this->role->id),
            PermissionValidation::make()->messages(),
        )->validate();
        try {
            $success = DB::transaction(function () use ($role) {
                $role->save();
                return [true, $role];
            });
        } catch (\Exception $e) {
            DB::rollback();
            return [false, $e->getMessage()];
        }
        return $success;
    }



}
