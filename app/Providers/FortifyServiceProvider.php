<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Responses\LoginResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
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
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::authenticateUsing(function (Request $request) {
            $user = \App\User::where('email', $request->email)->where('status','publish')->first();

            if ($user &&
                Hash::check($request->password, $user->password)) {
                return $user;
            }
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.passwords.email');
        });
        Fortify::resetPasswordView(function () {
            return view('auth.passwords.reset',[
                'request'=>request(),
                'page_title'=>__("Reset Password")
            ]);
        });

        Fortify::confirmPasswordView(function () {
            return view('auth.confirm-password',[
                'page_title'=>__("Confirm Password")
            ]);
        });

        Fortify::twoFactorChallengeView(function () {
            return view('auth.two-factor-challenge',[
                'page_title'=>__("Two Factor Challenge")
            ]);
        });

        Fortify::loginView(function () {
            return view('auth.login',[
                'page_title'=>__("Login")
            ]);
        });

        Fortify::verifyEmailView(function () {
            return view('auth.verify',[
                'page_title'=>__("Verify Email")
            ]);
        });

        $this->app->bind(\Laravel\Fortify\Http\Requests\LoginRequest::class, \App\Fortify\LoginRequest::class);
        $this->app->bind(\Laravel\Fortify\Contracts\LoginResponse::class, \App\Fortify\LoginResponse::class);
    }
}
