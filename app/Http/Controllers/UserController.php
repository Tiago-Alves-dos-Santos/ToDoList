<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function viewProfile(Request $request): Response
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        dd($user->hasEnabledTwoFactorAuthentication());
        $email_time_expiration = config('auth.verification.expire');
        return Inertia::render('Auth/Profile', [
            'email_time_expiration' => $email_time_expiration,
            // 'two_factor_isEnable' => $user->hasEnabledTwoFactorAuthentication()
        ]);
    }
    public function viewUpdatePassword($token): Response
    {
        return Inertia::render('Auth/UpdatePassword');
    }
}
