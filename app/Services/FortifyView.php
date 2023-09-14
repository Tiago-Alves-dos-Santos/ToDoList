<?php

namespace App\Services;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

final class FortifyView
{
    public function loginView(): Response
    {
        return Inertia::render('Home');
    }
    public function registerView(): Response
    {
        return Inertia::render('Home');
    }
    public function verifyEmailView(): Response
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $email_time_expiration = config('auth.verification.expire');
        return Inertia::render('Auth/VerifyEmail', [
            'verified_email' => $user->hasVerifiedEmail(),
            'email_time_expiration' => $email_time_expiration,
        ]);
    }
    public function forgotPasswordView(): Response
    {
        return Inertia::render('Auth/ForgotPassword');
    }
    public function resetPasswordView(): Response
    {
        return Inertia::render('Auth/ResetPassword');
    }
    public function authenticateUsing(Request $request, Model $model): mixed
    {
        return $this->genericLogin($request, $model);
    }

    private function genericLogin(Request $request, Model $model): mixed
    {
        $user = $model::where('email', $request->email)->first();
        $remember_me = (bool)$request->remember_me;

        if ($user && Hash::check($request->password, $user->password)) {
            if (!$user->hasVerifiedEmail()) {
                throw ValidationException::withMessages([
                    'email_verify' => 'Seu email não foi verificado! Sua conta será excluída após o prazo do email.',
                ]);
            } else {
                $user = Auth::guard('web')->login($user, $remember_me);

                if (Auth::viaRemember()) {
                    // Colocar cookies aqui
                } else {
                    // Remover cookies aqui
                }

                return $user;
            }
        }
    }

}
