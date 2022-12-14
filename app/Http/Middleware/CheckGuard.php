<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class CheckGuard
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Session::get('active_two_factor') === 'admin') {
            if (Route::currentRouteName() !== 'admin.two-factor.login') {
                return redirect()->route('admin.two-factor.login');
            }
        } else if (Session::get('active_two_factor') === 'web') {
            if (Route::currentRouteName() !== 'two-factor.login') {
                return redirect()->route('two-factor.login');
            }
        } else if (Auth::guard('admin')->check() || Auth::guard('web')->check()) {
            return redirect()->back();
        }
        return $next($request);
    }
}
