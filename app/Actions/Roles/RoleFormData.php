<?php

namespace App\Actions\Roles;


use App\Traits\Data;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Role;

class RoleFormData
{
    use AsAction;
    use Data;

    public function handle($type,$row=null): Role
    {

        return ( ($type==='update' || $type==='delete') && $row !== null) ? Role::find($row['id']) : new Role();
    }

}
