<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
// use Illuminate\Support\Str;

class CategoriaController extends Controller
{
    public function index(){
        return view('backend.categorias');
    }

    public function getCategorias(){
        $categorias = Categoria::all();
        return response()->json(array('categorias' => $categorias));
    }

    public function getById($id)
    {
        $categoria = Categoria::where('id', '=', $id)->first();
        return response()->json(array('categoria' => $categoria));
    }

    public function deletar(Request $request)
    {
        return Categoria::where('id', '=', $request->id)->delete();
    }
    

    public function cadastrar(Request $r){
        $cat = new Categoria;
        $cat->title = $r->titulo;
        $image = "";
            
        if($r->hasFile('imagen')){
            $reqImagen = $r->file('imagen');
            $extension = $reqImagen->extension();
            $imageName = md5($reqImagen->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $reqImagen->move(public_path('img/categorias'), $imageName);
            $image = $imageName;
        }

        $cat->img = $image;
        $cat->description = $r->descricao;
        $cat->active = 0;
        if ($cat->save()) {
            return redirect()->route('categorias');
        }
    }

    public function update(Request $r)
    {
       $te = Categoria::where('id', '=', $r->id)->first();
       $te->title = $r->title;
       $te->img = $r->img;
        $te->active = $r->active;
       $te->description = $r->description;
       
      if($te->save()){
            return response()->json(array('msg' => "Success"));
      }
    }
}
