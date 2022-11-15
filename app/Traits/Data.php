<?php

namespace App\Traits;

trait Data
{
    public static function uri_guard($request)
    {
        return explode('/', $request->getRequestUri())[1];
    }

    public function get_array_for_select_input($record){
        $array=[];
        foreach ($record as $data){
            $array[$data->id]=$data->name;
        }
        return $array;
    }
}
