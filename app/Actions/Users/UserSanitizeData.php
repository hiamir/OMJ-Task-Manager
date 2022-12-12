<?php

namespace App\Actions\Users;

use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\WithAttributes;

class UserSanitizeData
{
    use AsAction;
    use withAttributes;

    public function handle($data) :User{
        $data->name=strtolower($data->name);
        return $data;
    }

}
