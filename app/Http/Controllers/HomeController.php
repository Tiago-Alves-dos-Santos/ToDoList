<?php

namespace App\Http\Controllers;

use App\Enums\RoutesFortify;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // dd(prefixAuth(), config('fortify.prefix'));
        /** @var \App\Models\User $user */
        // $user = Auth::user();
        $email_time_expiration = config('auth.verification.expire');
        return Inertia::render('Auth/Home',[
            // 'verified_email' => $user->hasVerifiedEmail()
            'verified_email' =>  false,
            'email_time_expiration' => $email_time_expiration
        ]);
    }

}
