<?php

namespace App\Http\Controllers;

use App\Facades\FortifyViewFacade;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return FortifyViewFacade::homeView();

    }

}
