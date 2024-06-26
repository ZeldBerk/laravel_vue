<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\comentarios;
use App\Models\User;

class ComentariosController extends Controller
{
    // Extrae todos los comentarios de todas las recetas con 
    // el nombre de usuario nombre de la receta
    public function index(){
        $comentarios = comentarios::join('users', 'users.id', '=', 'comentarios.user_id')
        ->join('recetas', 'recetas.id', '=', 'comentarios.receta_id')
        ->select('comentarios.*', 'users.name', 'recetas.nombre')
        ->get();

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


    // Actualiza un comentario mediante su id
    public function update($id, Request $request){
            
        // Obtener receta a actualizar
        $comentario = comentarios::find($id);

        // Validar campos obligatorios
        $request->validate([
            'user_id' => 'required',
            'receta_id' => 'required',
            'contenido' => 'required',
            'puntuacion' => 'required'
        ]);

        $contToUpdate = $request->all();
        $comentario->update($contToUpdate);

        return response()->json(['success' => true, 'data' => $comentario]);
    }


    // Elimina el comentario por id
    public function destroy($id){

        $comentario = comentarios::find($id);

        $comentario->delete();

        return response()->json(['success' => true, 'data' => 'Comentario eliminado correctamente']);
    }


    // Devuelve los comentarios mediante el id de la receta
    public function show($receta_id){

        $comentarios = comentarios::where('receta_id', $receta_id)
            ->join('users', 'users.id', '=', 'comentarios.user_id')
            ->select('comentarios.*', 'users.name')
            ->orderBy('comentarios.puntuacion', 'desc')
            ->get();
    
        return $comentarios;
    }


    // Devuelve el comentario a partir del id
    public function find($id){

        $comentario = comentarios::find($id);

        return $comentario;
    }

    // Devuelve los comentarios asociados a un id de usuario
    public function showCA($user_id){

        $user = User::findOrFail($user_id);
        $roles = $user->roles;

        // Verificar si el usuario es admin o es user
        if ($roles->contains('name', 'admin')) {

            $query = comentarios::join('users', 'users.id', '=', 'comentarios.user_id')
            ->join('recetas', 'recetas.id', '=', 'comentarios.receta_id')
            ->select('comentarios.*', 'users.name', 'recetas.nombre');

        } else {

            $query = comentarios::join('users', 'users.id', '=', 'comentarios.user_id')
            ->join('recetas', 'recetas.id', '=', 'comentarios.receta_id')
            ->select('comentarios.*', 'users.name', 'recetas.nombre')
            ->where('comentarios.user_id', $user_id);

        }

        $comentarios = $query->get();

        return $comentarios;
    }
}
