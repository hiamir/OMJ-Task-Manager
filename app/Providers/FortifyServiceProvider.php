<?php

namespace App\Providers;
use App\Actions\Fortify\AdminRedirectIfTwoFactorAuthenticatable;
use App\Actions\Fortify\ConfirmPassword;
use App\Actions\Fortify\Controllers\ProfileInformationController;
use App\Actions\Fortify\Controllers\TwoFactorAuthenticatedSessionController;
use App\Actions\Fortify\Requests\TwoFactorLoginRequest;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Session;
use App\Actions\Fortify\PrepareAuthenticatedSession;
use Laravel\Fortify\Contracts\FailedTwoFactorLoginResponse;
use Laravel\Fortify\Contracts\TwoFactorLoginResponse;
use Laravel\Fortify\Fortify;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Controllers\AdminController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use App\Actions\Fortify\AttemptToAuthenticate;
use App\Actions\Fortify\RedirectIfTwoFactorAuthenticatable;
use App\Actions\Fortify\Controllers\NewPasswordController;
use App\Actions\Fortify\Controllers\PasswordResetLinkController;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application Services.
     *
     * @return void
     */
    public function register()
    {
        $this->app
            ->when([AdminController::class, AttemptToAuthenticate::class, AdminRedirectIfTwoFactorAuthenticatable::class,ConfirmPassword::class,PrepareAuthenticatedSession::class,
                PasswordResetLinkController::class, NewPasswordController::class,ProfileInformationController::class, UpdateUserProfileInformation::class,
                TwoFactorAuthenticatedSessionController::class,TwoFactorLoginRequest::class])
            ->needs(StatefulGuard::class)
            ->give(function () {

                return Auth::guard('admin');
            });

        $this->app
            ->when([UserController::class,RedirectIfTwoFactorAuthenticatable::class])
            ->needs(StatefulGuard::class)
            ->give(function () {

                return Auth::guard('web');
            });

        $this->app->instance(FailedTwoFactorLoginResponse::class, new class implements FailedTwoFactorLoginResponse {
            public function toResponse($request)
            {
                if(Session::get('active_two_factor') === 'admin'){
                    return redirect('admin/two-factor-challenge');
                }else{
                    return redirect('/two-factor-challenge');
                }


            }
        });



        $this->app->instance(TwoFactorLoginResponse::class, new class implements TwoFactorLoginResponse {
            public function toResponse($request)
            {
                if(Session::get('active_two_factor') === 'admin'){
                    Session::forget('active_two_factor');
                    return redirect('admin/dashboard');
                }else{
                    Session::forget('active_two_factor');
                    return redirect('/dashboard');
                }

            }
        });


    }

    /**
     * Bootstrap any application Services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string)$request->email;

            return Limit::perMinute(5)->by($email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
