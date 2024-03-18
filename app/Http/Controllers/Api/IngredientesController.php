<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ingrediente;
// use App\Models\ingredientes_recetas;

class IngredientesController extends Controller
{
    // Extrae todos los ingrdientes de la tabla ingredientes
    public function index(){

        $ingredientes = ingrediente::all()->toArray();
        return $ingredientes;
    }

    // Añade un comentario a la tabla comentario
    public function store(Request $request){

        // Validar campos obligatorios
        $request->validate([
            'nombre' => 'required'
        ]);

        // Guardamos la request en ingred y creamos el ingrediente
        $ingred = $request->all();
        $ingrediente = ingrediente::create($ingred);

        return response()->json(['success' => true, 'data' => $ingrediente]);
    }

    // Actualizar ingredientes
    public function update($id, Request $request){

        $ingrediente = ingrediente::find($id);

        $request->validate([
            'nombre'
        ]);

        $dataToUpdate = $request->all();
        $ingrediente->update($dataToUpdate);

        return response()->json(['success' => true, 'data' => $ingrediente]);
    }

    // Elimina el comentario por id
    public function destroy($id){
        
        $ingrediente = ingrediente::find($id);

        $ingrediente->delete();

        return response()->json(['success' => true, 'data' => 'Ingrediente eliminado correctamente']);
    }


}
