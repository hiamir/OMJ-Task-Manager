<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
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
    Route::middleware('guard-check')->get('/login', [UserController::class, 'create'])->name('login');
    Route::post('/login', [UserController::class, 'store']);
    Route::middleware('guard-check')->get('/two-factor-challenge', [TwoFactorAuthenticatedSessionController::class, 'create'])->name('two-factor.login');
    Route::middleware('guard-check')->get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::middleware('guard-check')->get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::middleware('guard-check')->post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::middleware('guard-check')->post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
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


