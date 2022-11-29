<?php

namespace App\Actions\Menu;

use App\Models\Menu;
use Lorisleiva\Actions\Concerns\AsAction;

class MenuValidation
{
    use AsAction;

    public function rules($id=null): array
    {
        return [
            'menu.name' => 'required|min:4|unique:menus,name,' . $id,
            'menu.parent_id' => 'numeric|gt:0|nullable',
            'menu.guards_id' => 'required|numeric|gt:0',
            'menu.svg' => 'unique:menus,svg,' . $id,
            'menu.route' => 'nullable',
            'menu.sort' => 'required|numeric|gt:0',
        ];
    }

    public function attributes($menu): array
    {
        return [
            'menu.name' =>$menu['name'],
            'menu.route' => 'Route',
            'menu.parent_id' => $menu['parent_id'],
            'menu.svg' => $menu['svg'],
        ];
    }

    public function messages(){
       return [
            'menu.name.required' => 'Menu name is required.',
            'menu.name.min' => 'Menu must be at-least 4 letters long.',
            'menu.name.unique' => ':attribute menu already exists!.',
            'menu.parent_id.integer' => ':attribute must be integer.',
            'menu.parent_id.gt' => ':attribute must be positive integer.',
            'menu.guards_id.required' => 'Guard is required.',
            'menu.guards_id.integer' => ':attribute must be integer.',
            'menu.guards_id.gt' => ':attribute must be positive integer.',
            'menu.svg.unique' => ':attribute already exists',
            'menu.route.required' => 'Select a route for this ',
            'menu.route.unique' => ':attribute already exists.',
            'menu.route.regex' => ':attribute is invalid',
            'menu.sort.required' => 'Give te order for this menu',
            'menu.sort.integer' => ':attribute must be integer.',
            'menu.sort.gt' => ':attribute must be positive integer.',
        ];
    }
}
