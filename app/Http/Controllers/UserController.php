<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile(): Response
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $email_time_expiration = config('auth.verification.expire');
        return Inertia::render('Auth/Profile', [
            'verified_email' => $user->hasVerifiedEmail(),
            'email_time_expiration' => $email_time_expiration,
        ]);
    }
}
