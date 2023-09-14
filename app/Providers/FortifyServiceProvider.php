<?php

namespace App\Providers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use App\Actions\Fortify\UpdateUserProfileInformation;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::authenticateUsing(function (Request $request) {

            $user = User::where('email', $request->email)->first();
            $remember_me = (bool)$request->remember_me;
            if ($user && Hash::check($request->password, $user->password)) {
                if (!$user->hasVerifiedEmail()) {
                    throw ValidationException::withMessages([
                        'email_verify' => 'Seu email não foi verficado! Sua conta sera excluida após o prazo do email.',
                    ]);
                } else {
                    $user = Auth::guard('web')->login($user, $remember_me);
                    if (Auth::viaRemember()) {
                        //colocar cokkies aq
                    } else {
                        //remover cokkies
                    }
                    return $user;
                }
            }
        });

        Fortify::loginView(function (Request $request) {
            return Inertia::render('Home');
        });
        Fortify::registerView(function (Request $request) {
            return Inertia::render('Home');
        });
        Fortify::verifyEmailView(function (Request $request) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $email_time_expiration = config('auth.verification.expire');
            return Inertia::render('Auth/VerifyEmail', [
                'verified_email' => $user->hasVerifiedEmail(),
                'email_time_expiration' => $email_time_expiration,
            ]);
        });
        Fortify::requestPasswordResetLinkView(function (Request $request) {
            return Inertia::render('Auth/ForgotPassword');
        });
        Fortify::resetPasswordView(function (Request $request) {
            return Inertia::render('Auth/ResetPassword');
        });

        // RateLimiter::for('login', function (Request $request) {
        //     $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

        //     return Limit::perMinute(5)->by($throttleKey);
        // });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
