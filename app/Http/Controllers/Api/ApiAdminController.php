<?php
namespace App\Http\Controllers\Api;

use App\Enums\Guard;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
/**
 * @OA\Info(
 *     title="Minha API Exemplo",
 *     description="Esta é uma API de exemplo para fins de demonstração.",
 *     version="1.0.0",
 *     @OA\Contact(
 *         name="Nome do Contato da API",
 *         email="contato@example.com"
 *     ),
 *     @OA\License(
 *         name="Licença de Exemplo",
 *         url="https://www.example.com/license"
 *     )
 * )
 */

class ApiAdminController extends Controller
{
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

    /**
     * @OA\Get(
     *     tags = {"User"},
     *     path="/api/admin/listUsers",
     *     summary="Obtém um exemplo pelo ID",
     *     description="Esta operação obtém um exemplo com base no ID fornecido.",
     *     @OA\Response(
     *         response="200",
     *         description="Sucesso - Exemplo encontrado",
     *         @OA\JsonContent(
     *             type="object",
        *         @OA\Property(
        *             property="id",
        *             type="integer",
        *             format="int64",
        *             example=1
        *         ),
        *         @OA\Property(
        *             property="nome",
        *             type="string",
        *             example="Exemplo 1"
        *         ),
        *         @OA\Property(
        *             property="outraPropriedade",
        *             type="string",
        *             example="Outro valor"
        *         )
     *         )
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Não encontrado - Nenhum exemplo encontrado com o ID fornecido"
     *     )
     * )
     */

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
    public function revoke(Request $request)
    {
        $admin = $request->user();
        $admin->currentAccessToken()->delete();
        $text_token =  $admin->createToken('api_key', ['list-users', 'list-admin-YourControl'])->plainTextToken;
        return response()->json([
            'message' => 'token revoked',
            'token' => $text_token
        ]);
    }
}
