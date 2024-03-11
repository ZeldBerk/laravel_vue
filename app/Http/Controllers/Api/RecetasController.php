<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\RecetasResource;
use App\Models\recetas;

class RecetasController extends Controller
{
    // Extrae todas las recetas de la BBDD
    public function index(){
        
        $recetas = recetas::all()->toArray();
        return $recetas;
    }

    // Añade una receta a la BBDD
    public function store(Request $request){

        // Validar campos obligatorios
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'ruta_imagen' => 'required',
            'raciones' => 'required',
            'tiempo_preparacion' => 'required',
            'user_id' => 'required',
            'categoria_id' => 'required'
        ]);

        $contReceta = $request->all();
        $receta = recetas::create($contReceta);

        return response()->json(['success' => true, 'data' => $receta]);
    }

    // Actualiza una receta
    public function update($id, Request $request){
        
        // Obtener receta a actualizar
        $receta = recetas::find($id);

        // Validar campos obligatorios
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'ruta_imagen' => 'required',
            'raciones' => 'required',
            'tiempo_preparacion' => 'required',
            'user_id' => 'required',
            'categoria_id' => 'required'
        ]);

        $contToUpdate = $request->all();
        $receta->update($contToUpdate);

        return response()->json(['success' => true, 'data' => $receta]);
    }

    // Elimina la receta mediante id
    public function destroy($id){

        $receta = recetas::find($id);

        $receta->delete();

        return response()->json(['success' => true, 'data' => 'Receta eliminada correctamanete']);
    }

    // Devuelve una receta mediante id
    public function show($id){

        $receta = recetas::find($id);

        return $receta;
    }

    // Devuelve las recetas asociadas a un id de usuario
    public function showRU($user_id){

        $recetas = recetas::where('user_id', $user_id)->get();

        return $recetas;
    }

}
