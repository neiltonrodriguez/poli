<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;


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
        $user = new User();
        $user->name = $r->nome;
        $user->email = $r->email;
        $user->password = bcrypt($r->password);
        $user->email_verified_at = now();
        $user->perfil_id = 2;
        $user->ativo = 0;
        if ($user->save()){
            return redirect()->route('login');
        }

    }

    // public function teste4(){
    //     $var1 = 5; 
    //     if ($var1 < 4){
    //         return view('teste4');
    //     } else {
    //         return "NÃO É MENOR";
    //     }
        
    // }

}
