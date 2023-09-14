<?php

namespace App\Http\Controllers;

use App\Enums\RoutesFortify;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        return Inertia::render('Auth/Home');
    }

}
