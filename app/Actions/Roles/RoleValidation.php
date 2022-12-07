<?php

namespace App\Actions\Roles;

use App\Models\Menu;
use Lorisleiva\Actions\Concerns\AsAction;

class RoleValidation
{
    use AsAction;

    public function rules($id=null): array
    {
        return [
            'role.name' => 'required|min:4|unique:roles,name,' . $id,
            'role.guard_name' => 'required',
        ];
    }

    public function attributes($role): array
    {
        return [
            'role.name' =>$role['name'],
        ];
    }

    public function messages(){
       return [
            'role.name.required' => 'Menu name is required.',
            'role.name.min' => 'Menu must be at-least 4 letters long.',
            'role.name.unique' => ':attribute menu already exists!.',
            'role.guard_name.required' => 'Guard is required.',
        ];
    }
}
