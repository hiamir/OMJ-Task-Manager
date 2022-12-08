<?php

namespace App\Actions\Users;

use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Permission;

class UserValidation
{
    use AsAction;

    public function rules($id=null): array
    {
        return [
            'user.name' => 'required|min:4',
            'user.email' => 'required|email|unique:users,email,' . $id,
        ];
    }

    public function validationAttributes($user): array
    {
        return [
            'user.name' =>$user['name'],
        ];
    }

    public function messages(){
       return [
            'user.name.required' => 'Permission name is required.',
           'user.name.min' => 'Permission must be at-least 4 letters long.',
            'user.email.required' => 'Permission name is required.',
            'user.email.email' => ':attribute must be valid email',
            'user.email.unique' => ':attribute menu already exists!.',
        ];
    }

//    public function updated(Permission $permission, $variable, $value){
//        switch ($variable){
//            case "user.name":
//                ($value==='') ? $permission['name']=(strtolower($permission['guard_name']) === 'web') ? 'user-'.strtolower($permission['model']).'-' : strtolower($permission['guard_name']).'-'.strtolower($permission['model']).'-' :  $permission['name']=$value;
//
//                break;
//            case "user.model":
//                $permission['name']=(strtolower($permission['guard_name']) === 'web') ? 'user-'.strtolower($value).'-' : strtolower($permission['guard_name']).'-'.strtolower($value).'-';
//                break;
//        }
//        ($permission['guard_name'] !== null && $permission['model'] !== null) ? $disabled=false : $disabled=true;
//
//        return $disabled;
//    }

}
