<?php

namespace App\Http\Controllers;

use App\Enums\Guard;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAdminController extends Controller
{
    private $guard = Guard::ADMIN;
    public function login(Request $request): mixed
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);
        $admin = Admin::where('email', $request->email)->first();
        $token = '';
        $message = '';
        if ($admin && Hash::check($request->password, $admin->password)) {
            //Aq estou simulando uma 'regra de negocio' que o 'model' só vai precisar e só pode ter um token
            if ($admin->tokens) {
                foreach ($admin->tokens as $value) {
                    if (!$value->expiredOrRevoked()) { //ver arquivo co começo 'PersonalAcessToken'
                        $message = 'O usuario já possui token valido e não expirado! Caso queira novo token, faça a revogação';
                    }
                }
            }
            if (empty($message)) {
                $token = $admin->createToken('api_key', ['list-users', 'list-admin-YourControl']);
            }
            return response()->json([
                'token' => $token->plainTextToken ?? '',
                'message' => $message
            ]);
        } else {
            abort(401, 'Invalid login'); //erro com status, mais indicado para api
        }
    }

    public function listUsers()
    {
        $user = request()->user();
        $user = $user->currentAccessToken();
        ds($user->can('list-users'));
        // return User::cursor();
    }
}
