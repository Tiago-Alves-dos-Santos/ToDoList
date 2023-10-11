<?php

namespace App\Http\Controllers;

use App\Enums\Guard;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
                $token = $admin->createToken('api_key', ['list-users', 'list-admin-YourControl']); //habilidades que eu inventei o nome, dica: faza algo para gerenciar
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
        //pega usuario de acordo com model 'tokenable_type' e 'tokenable_id'
        $admin = request()->user();
        $tokenHabilit  = $admin->currentAccessToken();
        if($tokenHabilit->can('list-users')){
            return User::cursor();
        }else{
            abort(401, 'Denied permision');
        }
    }
    public function listAdmins()
    {
        //pega usuario de acordo com model 'tokenable_type' e 'tokenable_id'
        $admin = request()->user();
        $tokenHabilit  = $admin->currentAccessToken();

        if(Gate::allows('listAllAdmins', $admin) && $tokenHabilit->can('list-admin-YourControl')){//verfica se o admin logado pode listar todos os admins
            $admins = Admin::where('id','!=', $admin->id)->orderBy('id','desc')->cursor();
        }else if($tokenHabilit->can('list-admin-YourControl')){//caso não, lista apenas oque ele cadastrou
            $admins = Admin::where('id','!=', $admin->id)->where('admin_creator_id', $admin->id)->orderBy('id','desc')->cursor();
        }else{
            abort(401, 'Denied permision');
        }
        return $admins;
    }
}
