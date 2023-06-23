<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\Categoria;

class FotosController extends Controller
{
    public function index(){
        $categorias = Categoria::all();
        return view('backend.fotos', compact('categorias'));
    }

    public function getAll(){
        $fotos = Foto::all();
        return response()->json(array('fotos' => $fotos));
    }

    public function addFotos(Request $r)
    {
        $foto = new Foto;
        $foto->alt = $r->alt;
        $image = "";

        if ($r->hasFile('imagen')) {
            $reqImagen = $r->file('imagen');
            $extension = $reqImagen->extension();
            $imageName = md5($reqImagen->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $reqImagen->move(public_path('img/fotos'), $imageName);
            $image = $imageName;
        }

        $foto->img = $image;
        $foto->description = $r->descricao;
        $active = 0;
        if ($r->active != null){
            $active = 1;
        }
        $foto->active = $active;
        $foto->id_categoria = $r->id_categoria;
        if ($foto->save()) {
            return redirect()->route('fotos');
        }
    }

    public function deletar(Request $request)
    {
        return Foto::where('id', '=', $request->id)->delete();
    }
}
