<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function viewRegister()
    {
        return Inertia::render('Admin/Register');
    }
    public function create(Request $request)
    {
    }
}
