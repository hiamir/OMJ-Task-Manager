<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group([
    'middleware' => 'guest:web',
], function () {
    Route::middleware('guard-check')->get('/login', [\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class, 'create'])->name('login');
    Route::middleware('guard-check')->get('/two-factor-challenge', [TwoFactorAuthenticatedSessionController::class, 'create'])->name('two-factor.login');
});


Route::middleware([
    'auth:sanctum,web',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::group([
        'middleware'=>'auth:web',
    ],function() {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        Route::post('logout', [\App\Http\Controllers\UserController::class, 'destroy'])->name('logout');
    });
});


