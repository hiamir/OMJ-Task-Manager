<?php

use App\Actions\Fortify\Controllers\TwoFactorAuthenticatedSessionController;
use App\Actions\Fortify\Controllers\TwoFactorAuthenticationController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\ConfirmedTwoFactorAuthenticationController;
use Laravel\Fortify\Http\Controllers\RecoveryCodeController;
use Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController;
use Laravel\Fortify\Http\Controllers\TwoFactorSecretKeyController;

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

Route::group([
    'middleware' => 'admin:admin',
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::middleware('guard-check')->get('login', [\App\Http\Controllers\AdminController::class, 'loginForm'])->name('login');
    Route::middleware('guard-check')->post('login', [\App\Http\Controllers\AdminController::class, 'store']);
    Route::post('two-factor-logout', [TwoFactorAuthenticatedSessionController::class, 'adminTwoFactorLogout'])->name('twoFactorLogout');
//    Route::get('forgot-password', [\App\Actions\Fortify\Controllers\PasswordResetLinkController::class, 'create'])->name('password.request');
//    Route::post('forgot-password', [\App\Actions\Fortify\Controllers\PasswordResetLinkController::class, 'store'])->name('password.email');
//    Route::get('reset-password/{token}', [\App\Actions\Fortify\Controllers\NewPasswordController::class, 'create'])->name('password.reset');
//    Route::post('reset-password', [\App\Actions\Fortify\Controllers\NewPasswordController::class, 'store'])->name('password.update');
    Route::middleware('guard-check')->get('/forgot-password', [\App\Actions\Fortify\Controllers\PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::middleware('guard-check')->get('/reset-password/{token}', [\App\Actions\Fortify\Controllers\NewPasswordController::class, 'create'])->name('password.reset');
    Route::middleware('guard-check')->post('/forgot-password', [\App\Actions\Fortify\Controllers\PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::middleware('guard-check')->post('/reset-password', [\App\Actions\Fortify\Controllers\NewPasswordController::class, 'store'])->name('password.update');
    Route::middleware('guard-check')->get('/two-factor-challenge', [TwoFactorAuthenticatedSessionController::class, 'create'])->name('two-factor.login');
    Route::post('/two-factor-challenge', [TwoFactorAuthenticatedSessionController::class, 'store'])->name('two-factor.store');;

//    Route::put('/user/profile-information', [ProfileInformationController::class, 'update'])
//        ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])
//        ->name('user-profile-information.update');
});


Route::middleware([
    'auth:sanctum,admin',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::group([
        'middleware' => 'auth:admin',
        'prefix' => 'admin',
        'as' => 'admin.'
    ], function () {
        Route::get('dashboard', function () {
            return view('admin/dashboard');
        })->name('dashboard');

        Route::get('/profile', [\App\Http\Controllers\Livewire\AdminProfileController::class, 'show'])->name('profile.show');
        Route::put('/profile-information', [\App\Actions\Fortify\Controllers\ProfileInformationController::class, 'update'])->name('user-profile-information.update');

        Route::post('/admin/two-factor-authentication', [TwoFactorAuthenticationController::class, 'store'])->name('two-factor.enable');

        Route::post('/admin/confirmed-two-factor-authentication', [ConfirmedTwoFactorAuthenticationController::class, 'store'])->name('two-factor.confirm');

        Route::delete('/admin/two-factor-authentication', [TwoFactorAuthenticationController::class, 'destroy'])
            ->name('two-factor.disable');

        Route::get('/admin/two-factor-qr-code', [TwoFactorQrCodeController::class, 'show'])
            ->name('two-factor.qr-code');

        Route::get('/admin/two-factor-secret-key', [TwoFactorSecretKeyController::class, 'show'])
            ->name('two-factor.secret-key');

        Route::get('/admin/two-factor-recovery-codes', [RecoveryCodeController::class, 'index'])
            ->name('two-factor.recovery-codes');

        Route::post('/admin/two-factor-recovery-codes', [RecoveryCodeController::class, 'store']);

        Route::post('logout', [\App\Http\Controllers\AdminController::class, 'destroy'])->name('logout');
    });
});
