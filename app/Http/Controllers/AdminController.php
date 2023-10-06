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
/**
 * Controller exclusivo do Admin
 */
class AdminController extends Controller
{
    /**
     * Lista adminis cadastrados com base no atual admin
     *
     * @param Request $request
     * @return Response
     */
    public function viewAdmins(Request $request) : Response {
        $admin = Auth::guard('admin')->user();
        $admins = null;
        if(Gate::allows('listAllAdmins', $admin)){//verfica se o admin logado pode listar todos os admins
            $admins = Admin::where('id','!=', $admin->id)->orderBy('id','desc')->cursor();
        }else{//caso não, lista apenas oque ele cadastrou
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
    /**
     * Cadastrar usuario e redireciona para pagina que fez a requisição, ele retorna um 'fn_data' com um a coluna 'name'
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request) : RedirectResponse
    {
        $new_admin = new CreateNewAdmin();
        $data = [
            ...$request->all(),
            'admin_creator_id' => $request->user()->id,
        ];
        //retornar o nome do usuario cadastrado
        $name = $new_admin->create($data)->name;
        return redirect()->back()->with(['data' => [
            'name' => $name
        ]]);
    }
    public function delete($id): void {
        $admin = Admin::find($id);
        if($this->authorize('deleteThe', $admin)){ //verifica se usuario pode deletar o mesmo
            $admin->delete();
        }
    }
}
