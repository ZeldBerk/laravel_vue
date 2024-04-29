<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ingrediente;
use App\Models\ingredientes_recetas;

class IngredientesController extends Controller
{
    // Extrae todos los ingrdientes de la tabla ingredientes
    public function index(){

        $ingredientes = ingrediente::all()->toArray();
        return $ingredientes;
    }

    // Añade un registro
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

    // Elimina el ingredeiente por id
    public function destroy($id){
        
        $ingrediente = ingrediente::find($id);

        $ingrediente->delete();

        return response()->json(['success' => true, 'data' => 'Ingrediente eliminado correctamente']);
    }


    // Recibe un ingrediente con el id de receta al que va asignado y generea el registro
    public function storeInReceta(Request $request){
        
        // Validar campos obligatorios
        $request->validate([
            'receta_id' => 'required',
            'ingrediente_id' => 'required',
        ]);

        $ingrediente = $request->all();
        $ingredienteReceta = ingredientes_recetas::create($ingrediente);

        return response()->json(['success' => true, 'data' => $ingredienteReceta]);
    }

    // Obtiene todos los ingredientes de una receta
    public function show($id){

        $ingredientes = ingredientes_recetas::where('receta_id', $id)
        ->join('ingredientes', 'ingredientes.id', '=', 'ingredientes_recetas.ingrediente_id')
        ->select('ingredientes_recetas.*', 'ingredientes.nombre')
        ->get();

        return $ingredientes;
    }

    // Actualizar los ingredientes de la receta 
    public function updateIngReceta($id, Request $request){

        $ingrediente_receta = ingredientes_recetas::find($id);

        $request->validate([
            'receta_id' => 'required',
            'ingrediente_id' => 'required',
        ]);

        $dataToUpdate = $request->all();
        $ingrediente_receta->update($dataToUpdate);

        return response()->json(['success' => true, 'data' => $ingrediente_receta]);
    }

    // Elimina un ingrediente de una receta
    public function deleteIngreReceta($id){

        $ingrediente_receta = ingredientes_recetas::find($id);

        $ingrediente_receta->delete();

        return response()->json(['success' => true, 'data' => 'Ingrediente eliminado de la receta correctamente']);
    }
}
