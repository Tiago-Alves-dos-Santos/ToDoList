<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Services\PageFront;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        // dd(request()->myUser());
        $guards = config('auth.guards');
        unset($guards['sanctum']);
        foreach ($guards as $guardName => $guardConfig) {
            $user = Auth::guard($guardName)->user();
            if (!empty($user)) {
                switch ($guardName) {
                    case 'web':
                        return redirect()->route('user.dashboard');
                        break;
                    case 'admin':
                        return redirect()->route('admin.dashboard');
                        break;

                    default:
                        # code...
                        break;
                }
            }
        }
    }

    public function homeUser(Request $request, array $data = []): Response
    {
        return Inertia::render('Auth/Home', $data);
    }
    public function adminHome(Request $request): Response
    {
        $pageFront = new PageFront($request->guard());
        ds()->clear();
        ds()->table((object)$pageFront->getLinks(),'MyTable');

        return Inertia::render('Auth/Home', [
            'menuLinks' => $pageFront->getLinks(),
            'title' => $pageFront->getTitlePage()
        ]);
    }
}
