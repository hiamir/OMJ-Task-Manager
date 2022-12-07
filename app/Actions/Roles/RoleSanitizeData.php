<?php

namespace App\Actions\Roles;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\WithAttributes;
use Spatie\Permission\Models\Role;

class RoleSanitizeData
{
    use AsAction;
    use withAttributes;

    public function handle($data) :Role{
        $data->name=ucfirst($data->name);
        return $data;
    }

}
