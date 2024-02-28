<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\comentarios;

class ComentariosController extends Controller
{
    // Extrae todos los comentarios de todas las recetas
    public function index(){
        $comentarios = comentarios::all()->toArray();
        return $comentarios;
    }

    // Añade un comentario a la BBDD
    public function store(Request $request){

        // Validar campos obligatorios
        $request->validate([
            'user_id' => 'required',
            'receta_id' => 'required',
            'contenido' => 'required',
            'puntuacion' => 'required'
        ]);

        // Guardamos la request en coment y creamos el comentario
        $coment = $request->all();
        $comentario = comentarios::create($coment);

        return response()->json(['success' => true, 'data'=> $comentario]);
    }


    // Elimina el comentario por id
    public function destroy($id){

        $comentario = comentarios::find($id);

        $comentario->delete();

        return response()->json(['success' => true, 'data' => 'Comentario eliminado correctamente']);
    }


    // Devuelve el comentario mediante el id
    public function show($id){

        $comentario = comentarios::find($id);

        return $comentario;
    }
}
