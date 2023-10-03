<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Actions\Admin\CreateNewAdmin;
use App\Models\Admin;
use Inertia\Response;

class AdminController extends Controller
{
    public function viewAdmins() : Response {
        $admins = Admin::orderBy('id','desc')->cursor();
        return Inertia::render('Admin/Admins', [
            'admins' => $admins
        ]);
    }
    public function viewRegister()
    {
        return Inertia::render('Admin/Register');
    }
    public function create(Request $request)
    {
        $new_admin = new CreateNewAdmin();
        $data = [
            ...$request->all(),
            'admin_creator_id' => $request->user()->id,
        ];
        $name = $new_admin->create($data)->name;
        return redirect()->back()->with(['data' => [
            'name' => $name
        ]]);
    }
}
