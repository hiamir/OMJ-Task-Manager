<?php

namespace App\Actions\Users;


use App\Models\User;
use App\Traits\Data;
use Lorisleiva\Actions\Concerns\AsAction;

class UserFormData
{
    use AsAction;
    use Data;

    public function handle($type,$row=null): User
    {
        return ( ($type==='update' || $type==='delete') && $row !== null) ? User::find($row['id']) : new User();
    }

}
