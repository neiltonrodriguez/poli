<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Perfil;


class UserController extends Controller
{
    public function index(){

        return view('login');

    }

    public function registro()
    {

        return view('cadastro_user');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function autenticar(Request $request)
    {

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'ativo' => 1])) {
            // $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return redirect()->back()->with('danger', 'email ou senha inválida');
    }

    public function cadastrar(Request $r)
    {
        // dd($r);
        $user = new User();
        $user->name = $r->nome;
        $user->email = $r->email;
        $user->password = bcrypt($r->password);
        $user->email_verified_at = now();
        $perfil = 2;
        if(isset($r->perfil)){
            $perfil = $r->perfil;
        }
        $user->perfil_id = $perfil;
        $ativo = 0;
        if (isset($r->active)) {
            $ativo = $r->active;
        }
        $user->ativo = $ativo;
        if (isset($r->active)) {
            if ($user->save()) {
                return redirect()->route('usuarios');
            }
        }else {
            if ($user->save()) {
                return redirect()->route('login');
            }
        }


    }
    public function editar(Request $request, $id)
    {
        // Encontra o usuário com base no ID fornecido
        $user = User::find($id);

        // Verifica se o usuário existe
        if (!$user) {
            return "Usuário não encontrado";
        }

        // Atualiza as propriedades do usuário com base nos dados fornecidos no formulário
        $user->name = $request->input('nome');
        $user->email = $request->input('email');

        // Atualiza a senha do usuário, se fornecida
        $password = $request->input('password');
        if (!empty($password)) {
            $user->password = bcrypt($password);
        }

        // Define a data de verificação de e-mail como o momento atual
        $user->email_verified_at = now();

        // Define o perfil do usuário com base nos dados fornecidos no formulário
        $perfil = $request->input('perfil', 2);
        $user->perfil_id = $perfil;

        // Define o status do usuário com base na checkbox "active" do formulário
        $user->ativo = $request->has('active') ? 1 : 0;

        // Salva as alterações no banco de dados
        if ($user->save()) {
            if ($request->has('active')) {
                // Redireciona para a rota "usuarios" se a checkbox "active" estiver marcada
                return redirect()->route('usuarios');
            } else {
                // Retorna a visão (view) "edit_user" com o ID do usuário
                return view('backend.modais.edit_user', ['id' => $id]);
            }
        } else {
            // Retorna uma resposta de erro em caso de falha ao salvar as alterações
            return "Erro ao salvar as alterações do usuário";
        }
    }





    public function home()
    {
        $perfis = Perfil::all();
        return view('backend.usuarios', compact('perfis'));
    }

    public function getAll()
    {
        $usuarios = User::all();
        return response()->json(array('usuarios' => $usuarios));
    }

    public function deletar(Request $request)
    {
        return User::where('id', '=', $request->id)->delete();
    }

    public function active(Request $r)
    {

        $c = User::where('id', '=', $r->id)->first();
        if ($c->ativo == 1) {
            $c->ativo = 0;
        } else {
            $c->ativo = 1;
        }
        // dd($c);
        if ($c->save()) {
            return response()->json(array('msg' => "Success"));
        }
    }


}
