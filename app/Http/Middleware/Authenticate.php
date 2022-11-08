<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if(Auth::guard('admin')->check()){
            return route('admin.dashboard');
        }else if(Auth::guard('web')->check()){
            return route('dashboard');
        }

        if (! $request->expectsJson()) {

                $uri=explode('/',$request->getRequestUri());
                return ( ($uri[1] === 'admin') ? route('admin.login') : route('login'));


        }
    }
}
