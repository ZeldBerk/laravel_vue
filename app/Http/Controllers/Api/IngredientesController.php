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


    // Recibe un array de ongredeientes e inserta los ingredeientes relacionados con la receta
    public function storeInReceta(Request $request){
        
        $ingredientes = $request->all();

        // Iterar sibre cada ingrediente y guardar el registro en la tabla
        foreach ($ingredientes as $ingrediente) {
            $ingrediente->validate([
                'receta_id' => 'required',
                'ingrediente_id' => 'required',
                'cantidad' => 'required',
                'unidad' => 'required'
            ]);

            // Creamos el registro
            $ingredienteStored = ingredientes_recetas::create($ingrediente);
        }

        return response()->json(['success' => true, 'data' => 'Ingredeientes receta guardados correctamente']);
    }

}
