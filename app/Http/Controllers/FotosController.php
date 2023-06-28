<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
class FotosController extends Controller
{
    public function index(){
        $categorias = Categoria::all();
        // $fotos = DB::table('foto')->paginate(3);
        $data["categorias"] = $categorias;
        // $data["fotos"] = $fotos;
        return view('backend.fotos')->with('data', $data);
    }

    public function getAll(){
        $query = Foto::query();
        $fotos = $query->paginate();
        return $fotos;
    }

    public function filterPhotos(Request $filtro)
    {
        // dd($filtro);
        $query = Foto::query();
        if ($filtro->has('active')) {
            $query->where('active', '=', $filtro->active);
        }

        if ($filtro->has('search')) {
            $query->where('alt', 'LIKE', '%' . $filtro->search . '%');
        }

        if ($filtro->has('categoria') && $filtro->categoria != 0) {
            $query->where('id_categoria', '=', $filtro->categoria);
        }
        

        $fotos = $query->paginate();
       
        return  $fotos;
    }

    public function addFotos(Request $r)
    {
        $imagens = $r->file('imagen');
        foreach($imagens as $key => $image){
            $extension = $image->extension();
            $imageName = md5($image->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $image->move(public_path('img/fotos'), $imageName);

            $foto = new Foto;
            $foto->alt = $r->alt;
            $foto->img = $imageName;
            $foto->description = $r->descricao;
            $active = 0;
            if ($r->active != null){
                $active = 1;
            }
            $foto->active = $active;
            $foto->id_categoria = $r->id_categoria;
            $foto->save();
        }
        return redirect()->route('fotos');
       
    }

    public function deletar(Request $request)
    {
        return Foto::where('id', '=', $request->id)->delete();
    }


    public function active(Request $r)
    {
        $c = Foto::where('id', '=', $r->id)->first();
        if ($c->active == 1) {
            $c->active = 0;
        } else {
            $c->active = 1;
        }
        // dd($c);
        if ($c->save()) {
            return response()->json(array('msg' => "Success"));
        }
    }
}
