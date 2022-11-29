<?php

namespace App\Actions\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\WithAttributes;

class MenuSanitizeData
{
    use AsAction;
    use withAttributes;

    public function handle($data) :Menu{
        $data->name=ucfirst($data->name);
        if($data->route=="null") $data->route=null;
        if($data->parent_id=="null") $data->parent_id=null;
        return $data;
    }



}
