<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Fortify\Features;

class AdminUserController extends Controller
{
    /**
     * Lista de usuarios
     *
     * @return Response
     */
    public function viewListUsers():Response
    {
        $users = User::orderBy('id', 'desc')->cursor();
        return Inertia::render('Admin/Users', [
            'users' => $users,
        ]);
    }

    /**
     * Desabilitar 2FA de usuario
     *
     * @param [type] $id
     * @return void
     */
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
    /**
     * Ativar e desativar usuario
     *
     * @param [type] $id
     * @return void
     */
    public function toggleActive($id) : void
    {
        $user = User::find($id);
        $user->active = !$user->active;
        $user->save();
    }
}
