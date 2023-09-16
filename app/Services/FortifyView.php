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
use Illuminate\Http\Exceptions\HttpResponseException;

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
    public function resetPasswordView(Request $request): Response
    {
        $token = $request->token;
        $email = $request->email;
        return Inertia::render('Auth/ResetPassword', compact(
            'token',
            'email'
        ));
    }
    public function twoFactorChallengeView(Request $request): Response
    {
        return Inertia::render('Auth/TwoFactorChallenge');
    }

}
