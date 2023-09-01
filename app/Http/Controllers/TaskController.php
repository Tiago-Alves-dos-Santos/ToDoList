<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

use Inertia\Response;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Home');
    }
}
