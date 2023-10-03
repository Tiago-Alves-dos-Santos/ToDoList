<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Laravel\Fortify\Features;

class AdminUserController extends Controller
{
    public function viewListUsers()
    {
        $users = User::orderBy('id', 'desc')->cursor();
        return Inertia::render('Admin/Users', [
            'users' => $users,
        ]);
    }

    public function disable2FAUser($id) : void
    {
        $values = [
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
        ];
        if(Features::optionEnabled(Features::twoFactorAuthentication(), 'confirm')){
            $values['two_factor_confirmed_at'] = null;
        }
        User::find($id)->update($values);
    }
    public function toggleActive($id) : void
    {
        $user = User::find($id);
        $user->active = !$user->active;
        $user->save();
    }
}
