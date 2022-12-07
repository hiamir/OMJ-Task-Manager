<?php

namespace App\Actions\Permissions;

use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\WithAttributes;
use Spatie\Permission\Models\Permission;

class PermissionSanitizeData
{
    use AsAction;
    use withAttributes;

    public function handle($data) :Permission{
        $data->name=ucfirst($data->name);
        return $data;
    }

}
