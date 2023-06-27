<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\Categoria;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $qtdeFotos = Foto::count();
        $qtdeCategorias = Categoria::count();
        $qtdeUsers = User::count();
        $data["qtdeFotos"] = $qtdeFotos;
        $data["qtdeCategorias"] = $qtdeCategorias;
        $data["qtdeUsers"] = $qtdeUsers;
        return view('backend.home')->with('data', $data);
    }
}
