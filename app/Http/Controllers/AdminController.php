<?php

namespace App\Http\Controllers;

use App\Actions\Admin\CreateNewAdmin;
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

        $new_admin = new CreateNewAdmin();
        $name = $new_admin->create($request->all())->name;
        return redirect()->back()->with(['data' => [
            'name' => $name
        ]]);
    }
}
