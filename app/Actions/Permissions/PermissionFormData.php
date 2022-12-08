<?php

namespace App\Actions\Permissions;


use App\Traits\Data;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Permission;

class PermissionFormData
{
    use AsAction;
    use Data;

    public function handle($type,$row=null): Permission
    {
        return ( ($type==='update' || $type==='delete') && $row !== null) ? Permission::find($row['id']) : new Permission();
    }

}
