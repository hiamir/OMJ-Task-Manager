<?php

namespace App\Traits;

trait Data
{
    public static function uri_guard($request)
    {
        return explode('/', $request->getRequestUri())[1];
    }
}
