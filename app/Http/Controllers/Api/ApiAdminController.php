<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;


/**
 * @OA\Server(
 *     url="http://localhost:8000/api/"
 * ),
 * @OA\Info(
 *     title="Api para administração",
 *     description="Esta é uma API de demonstração básica do swagger ui",
 *     version="1.0.0-beta",
 *     @OA\Contact(
 *         name="Tiago Alves dos Santos de Oliveira",
 *         email="tiagooliveiraaso@gmail.com"
 *     ),
 *     @OA\License(
 *         name="Licença MIT",
 *         url=""
 *     ),
 * ),
 *
 *  @OA\SecurityScheme(
 *      securityScheme="BearerAuth",
 *      in="header",
 *      name="Authorization",
 *      type="apiKey",
 *      description = "Cabeçalho de autenticação Bearer"
 * )
 */

class ApiAdminController extends Controller
{
    /**
     * @OA\Post(
     *     tags = {"Administradores"},
     *     path="/admin/login",
     *     summary="Obtem o token",
     *     description="Resulta em um token ou mensagem de erro.",
     *     @OA\RequestBody(
     *         description="Dados do usuário para autenticação",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 format="email",
     *                 example="usuario@example.com"
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 type="string",
     *                 format="password",
     *                 example="senha123"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *        response="200",
     *        description="Sucesso - Exemplo encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                  property="token",
     *                  type="string",
     *                  example="<seu_token>"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="O usuario já possui token valido e não expirado! Caso queira novo token, faça a revogação"
     *              ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Invalid login"
     *     )
     * )
     */
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
     *     tags = {"Administradores"},
     *     path="/admin/list/users",
     *     summary="Obtem uma lista de usuarios",
     *     description="Retorna todos os usuarios caso admin",
     *     security={
     *         {"BearerAuth": {}}
     *     },
     *     @OA\Response(
     *         response="200",
     *         description="Sucesso - Exemplo encontrado",
     *         @OA\JsonContent(
     *               type="array",
     *               @OA\Items(
     *                   type="object",
     *                   @OA\Property(
     *                       property="id",
     *                       type="integer",
     *                       format="int64",
     *                       example=1
     *                   ),
     *                   @OA\Property(
     *                       property="name",
     *                       type="string",
     *                       example="Roberto Anderson Carrara"
     *                   ),
     *                   @OA\Property(
     *                       property="email",
     *                       type="string",
     *                       example="hgil@example.org"
     *                   ),
     *                   @OA\Property(
     *                       property="active",
     *                       type="boolean",
     *                       example=true
     *                   ),
     *                   @OA\Property(
     *                       property="email_verified_at",
     *                       type="string",
     *                       format="date-time",
     *                       example="2023-10-09T14:49:29.000000Z"
     *                   ),
     *                   @OA\Property(
     *                       property="created_at",
     *                       type="string",
     *                       format="date-time",
     *                       example="2023-10-09T14:49:29.000000Z"
     *                   ),
     *                   @OA\Property(
     *                       property="updated_at",
     *                       type="string",
     *                       format="date-time",
     *                       example="2023-10-09T14:49:29.000000Z"
     *                   ),
     *                   @OA\Property(
     *                       property="two_factor_confirmed_at",
     *                       type="string",
     *                       format="date-time",
     *                       example=null
     *                   ),
     *                   @OA\Property(
     *                       property="two_factor_is_active",
     *                       type="boolean",
     *                       example=false
     *                   )
     *               ),
     *         ),
     *         @OA\Header(
     *           header="Authorization",
     *           description="token de usuario autenticado",
     *             @OA\Schema(
     *                 type="string",
     *                 example="Bearer <token value>"
     *             )
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Denied permision"
     *     ),
     * )
     */

    public function listUsers()
    {
        //pega usuario de acordo com model 'tokenable_type' e 'tokenable_id'
        $admin = request()->user();
        $tokenHabilit  = $admin->currentAccessToken();
        if ($tokenHabilit->can('list-users')) {
            return User::cursor();
        } else {
            abort(401, 'Denied permision');
        }
    }
    /**
     * @OA\Get(
     *     tags = {"Administradores"},
     *     path="/admin/list/admins",
     *     summary="Obtém uma lista de administratores",
     *     description="Retorna administradores, todos caso admin master ou apenas os adminis caadasrtados pelo admin comum",
     *     security={
     *         {"BearerAuth": {}}
     *     },
     *     @OA\Response(
     *         response="200",
     *         description="Sucesso - Exemplo encontrado",
     *         @OA\JsonContent(
     *               type="array",
     *               @OA\Items(
     *                   type="object",
     *                   @OA\Property(
     *                       property="id",
     *                       type="integer",
     *                       format="int64",
     *                       example=2
     *                   ),
     *                   @OA\Property(
     *                       property="admin_creator_id",
     *                       type="integer",
     *                       format="int64",
     *                       example=1
     *                   ),
     *                   @OA\Property(
     *                       property="type",
     *                       type="string",
     *                       example="common"
     *                   ),
     *                   @OA\Property(
     *                       property="name",
     *                       type="string",
     *                       example="Roberto Anderson Carrara"
     *                   ),
     *                   @OA\Property(
     *                       property="email",
     *                       type="string",
     *                       example="hgil@example.org"
     *                   ),
     *                   @OA\Property(
     *                       property="active",
     *                       type="boolean",
     *                       example=true
     *                   ),
     *                   @OA\Property(
     *                       property="email_verified_at",
     *                       type="string",
     *                       format="date-time",
     *                       example="2023-10-09T14:49:29.000000Z"
     *                   ),
     *                   @OA\Property(
     *                       property="created_at",
     *                       type="string",
     *                       format="date-time",
     *                       example="2023-10-09T14:49:29.000000Z"
     *                   ),
     *                   @OA\Property(
     *                       property="updated_at",
     *                       type="string",
     *                       format="date-time",
     *                       example="2023-10-09T14:49:29.000000Z"
     *                   ),
     *                   @OA\Property(
     *                       property="two_factor_confirmed_at",
     *                       type="string",
     *                       format="date-time",
     *                       example=null
     *                   ),
     *                   @OA\Property(
     *                       property="two_factor_is_active",
     *                       type="boolean",
     *                       example=false
     *                   )
     *               ),
     *         ),
     *         @OA\Header(
     *           header="Authorization",
     *           description="token de usuario autenticado",
     *             @OA\Schema(
     *                 type="string",
     *                 example="Bearer <token value>"
     *             )
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Denied permision"
     *     ),
     * )
     */
    public function listAdmins()
    {
        //pega usuario de acordo com model 'tokenable_type' e 'tokenable_id'
        $admin = request()->user();
        $tokenHabilit  = $admin->currentAccessToken();

        if (Gate::allows('listAllAdmins', $admin) && $tokenHabilit->can('list-admin-YourControl')) { //verfica se o admin logado pode listar todos os admins
            $admins = Admin::where('id', '!=', $admin->id)->orderBy('id', 'desc')->cursor();
        } else if ($tokenHabilit->can('list-admin-YourControl')) { //caso não, lista apenas oque ele cadastrou
            $admins = Admin::where('id', '!=', $admin->id)->where('admin_creator_id', $admin->id)->orderBy('id', 'desc')->cursor();
        } else {
            abort(401, 'Denied permision');
        }
        return $admins;
    }
    /**
     * @OA\Post(
     *     tags = {"Administradores"},
     *     path="/admin/revoke",
     *     summary="Recebe um novo token de acesso",
     *     description="Recebe um novo token de acesso, indepedente do status atual.",
     *     security={
     *         {"BearerAuth": {}}
     *     },
     *     @OA\Response(
     *        response="200",
     *        description="Sucesso - Exemplo encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                  property="token",
     *                  type="string",
     *                  example="<seu_token>"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="O usuario já possui token valido e não expirado! Caso queira novo token, faça a revogação"
     *              ),
     *         ),
     *         @OA\Header(
     *           header="Authorization",
     *           description="token de usuario autenticado",
     *             @OA\Schema(
     *                 type="string",
     *                 example="Bearer <token value>"
     *             )
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Invalid login"
     *     )
     * ),
     */
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
