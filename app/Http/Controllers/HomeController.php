<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        return $this->homeUser($request);
    }

    private function homeUser(Request $request,array $data = []): Response
    {
        return Inertia::render('Auth/Home', $data);
    }

}
