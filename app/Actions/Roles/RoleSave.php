<?php

namespace App\Actions\Roles;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\WithAttributes;
use Spatie\Permission\Models\Role;

class RoleSave
{
    use AsAction;
    use withAttributes;


    /**
     * @throws ValidationException
     */
    public function handle(Role $role):array
    {
      $role= RoleSanitizeData::run($role);
        $data = $this->set('role', $role)->fill($role->toArray());
        Validator::make(
            $data->attributes,
            RoleValidation::make()->rules($this->role->id),
            RoleValidation::make()->messages(),
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
