<?php

namespace App\Actions\Fortify\Controllers;


use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Contracts\FailedTwoFactorLoginResponse;
use Laravel\Fortify\Contracts\TwoFactorChallengeViewResponse;
use Laravel\Fortify\Contracts\TwoFactorLoginResponse;
use Laravel\Fortify\Events\RecoveryCodeReplaced;
use App\Actions\Fortify\Requests\TwoFactorLoginRequest;

class TwoFactorAuthenticatedSessionController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param \Illuminate\Contracts\Auth\StatefulGuard $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Show the two factor authentication challenge view.
     *
     * @param \Laravel\Fortify\Http\Requests\TwoFactorLoginRequest $request
     * @return \Laravel\Fortify\Contracts\TwoFactorChallengeViewResponse
     */
    public function create(TwoFactorLoginRequest $request): TwoFactorChallengeViewResponse
    {
        if (!$request->hasChallengedUser()) {
            throw new HttpResponseException(redirect()->route('admin.login'));
        }

        return app(TwoFactorChallengeViewResponse::class);
    }

    /**
     * Attempt to authenticate a new session using the two factor authentication code.
     *
     * @param \Laravel\Fortify\Http\Requests\TwoFactorLoginRequest $request
     * @return mixed
     */
    public function store(TwoFactorLoginRequest $request)
    {
        $user = $request->challengedUser();
        if ($code = $request->validRecoveryCode()) {
            $user->replaceRecoveryCode($code);

            event(new RecoveryCodeReplaced($user, $code));
        } elseif (!$request->hasValidCode()) {
            return app(FailedTwoFactorLoginResponse::class)->toResponse($request);
        }
        $this->guard->login($user, $request->remember());

        $request->session()->regenerate();
        return app(TwoFactorLoginResponse::class);
    }

    public function adminTwoFactorLogout(Request $request)
    {
       $session=Session::get('active_two_factor');
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return (($session === 'admin') ? redirect()->route('admin.login') : redirect()->route('login'));
    }
}
