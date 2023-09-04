<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function index(Request $request)
    {
        // dd(Auth::logout());
        return Inertia::render('Home');
    }
}
