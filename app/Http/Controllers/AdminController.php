<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Actions\Admin\CreateNewAdmin;

class AdminController extends Controller
{
    public function viewRegister()
    {
        return Inertia::render('Admin/Register');
    }
    public function viewListUsers()
    {
        $users = User::cursor();
        return Inertia::render('Admin/Users', [
            'users' => $users,
        ]);
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
