<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\Categoria;

class DashboardController extends Controller
{
    public function index(){
        $qtdeFotos = Foto::count();
        $qtdeCategorias = Categoria::count();
        $data["qtdeFotos"] = $qtdeFotos;
        $data["qtdeCategorias"] = $qtdeCategorias;
        return view('backend.home')->with('data', $data);
    }
}
