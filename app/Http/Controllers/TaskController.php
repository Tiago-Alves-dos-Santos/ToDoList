<?php

namespace App\Http\Controllers;

use App\Models\User;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Task/Index');
    }
}
