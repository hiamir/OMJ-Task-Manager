<?php

namespace App\Actions\Users;

use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\WithAttributes;
use Spatie\Permission\Models\Permission;

class UserSanitizeData
{
    use AsAction;
    use withAttributes;

    public function handle($data) :Permission{
        $data->name=strtolower($data->name);
        return $data;
    }

}
