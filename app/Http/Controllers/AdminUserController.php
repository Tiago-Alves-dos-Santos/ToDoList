<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Features;

class AdminUserController extends Controller
{
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
