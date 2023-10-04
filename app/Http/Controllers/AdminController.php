<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Admin;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Actions\Admin\CreateNewAdmin;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function viewAdmins(Request $request) : Response {
        $admin = Auth::guard('admin')->user();
        $admins = null;
        if(Gate::allows('listAllAdmins', $admin)){
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
