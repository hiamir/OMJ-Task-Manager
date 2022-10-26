<?php

use Illuminate\Support\Facades\Route;

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
    Route::get('login', [\App\Http\Controllers\AdminController::class, 'loginForm'])->name('login');
    Route::post('login', [\App\Http\Controllers\AdminController::class, 'store']);
//    Route::get('forgot-password', [\App\Actions\Fortify\Controllers\PasswordResetLinkController::class, 'create'])->name('password.request');
//    Route::post('forgot-password', [\App\Actions\Fortify\Controllers\PasswordResetLinkController::class, 'store'])->name('password.email');
//    Route::get('reset-password/{token}', [\App\Actions\Fortify\Controllers\NewPasswordController::class, 'create'])->name('password.reset');
//    Route::post('reset-password', [\App\Actions\Fortify\Controllers\NewPasswordController::class, 'store'])->name('password.update');
    Route::get('/forgot-password', [\App\Actions\Fortify\Controllers\PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::get('/reset-password/{token}', [\App\Actions\Fortify\Controllers\NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/forgot-password', [\App\Actions\Fortify\Controllers\PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::post('/reset-password', [\App\Actions\Fortify\Controllers\NewPasswordController::class, 'store'])->name('password.update');


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
        Route::post('logout', [\App\Http\Controllers\AdminController::class, 'destroy'])->name('logout');
    });
});
