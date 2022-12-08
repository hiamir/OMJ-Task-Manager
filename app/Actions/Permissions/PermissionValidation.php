<?php

namespace App\Actions\Permissions;

use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Permission;

class PermissionValidation
{
    use AsAction;

    public function rules($id=null): array
    {
        return [
            'permission.name' => 'required|min:4|unique:permissions,name,' . $id,
            'permission.model' => 'required',
            'permission.guard_name' => 'required',
        ];
    }

    public function validationAttributes($permission): array
    {
        return [
            'permission.name' =>$permission['name'],
        ];
    }

    public function messages(){
       return [
            'permission.name.required' => 'Permission name is required.',
            'permission.name.min' => 'Permission must be at-least 4 letters long.',
            'permission.name.unique' => ':attribute menu already exists!.',
            'permission.model.required' => 'Model is required.',
            'permission.guard_name.required' => 'Guard is required.',
        ];
    }

    public function updated(Permission $permission, $variable, $value){
        switch ($variable){
            case "permission.name":
                ($value==='') ? $permission['name']=(strtolower($permission['guard_name']) === 'web') ? 'user-'.strtolower($permission['model']).'-' : strtolower($permission['guard_name']).'-'.strtolower($permission['model']).'-' :  $permission['name']=$value;

                break;
            case "permission.model":
                $permission['name']=(strtolower($permission['guard_name']) === 'web') ? 'user-'.strtolower($value).'-' : strtolower($permission['guard_name']).'-'.strtolower($value).'-';
                break;
        }
        ($permission['guard_name'] !== null && $permission['model'] !== null) ? $disabled=false : $disabled=true;

        return $disabled;
    }

}
