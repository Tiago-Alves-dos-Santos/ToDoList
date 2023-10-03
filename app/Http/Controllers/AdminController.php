<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Actions\Admin\CreateNewAdmin;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class AdminController extends Controller
{
    public function viewAdmins(Request $request) : Response {
        $admin = Auth::guard('admin')->user();
        $admins = null;
        if($this->authorize('listAllAdmins', $admin)){
            $admins = Admin::where('id','!=', $admin->id)->orderBy('id','desc')->cursor();
        }else{
            $admins = Admin::where('id','!=', $admin->id)->where('admin_creator_id', $admin->id)->orderBy('id','desc')->cursor();
        }
        return Inertia::render('Admin/Admins', [
            'admins' => $admins
        ]);
    }
    public function viewRegister()
    {
        return Inertia::render('Admin/Register');
    }
    public function create(Request $request) : RedirectResponse
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
    public function delete($id): void {
        $admin = Admin::find($id);
        if($this->authorize('deleteThe', $admin)){
            $admin->delete();
        }
    }
}
