<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $this->homeUser($request);
    }

    private function homeUser(Request $request,array $data = []): Response
    {
        return Inertia::render('Auth/Home', $data);
    }

}
