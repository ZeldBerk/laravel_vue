<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ingrediente;

class IngredientesController extends Controller
{
    // Extrae todos los ingrdientes de la tabla ingredientes
    public function index(Request $request)
    {

        $filtro = $request->input('filtro');

        $query = ingrediente::query(); 

        if ($filtro) {
            $query->where('nombre', 'like', '%' . $filtro . '%');
        }

        $ingredientes = $query->get(); 

        return $ingredientes;
    }


    // Añade un registro
    public function store(Request $request)
    {

       
        $request->validate([
            'nombre' => 'required'
        ]);

        
        $ingred = $request->all();
        $ingrediente = ingrediente::create($ingred);

        return response()->json(['success' => true, 'data' => $ingrediente]);
    }

    // Actualizar ingredientes
    public function update($id, Request $request)
    {

        $ingrediente = ingrediente::find($id);

        $request->validate([
            'nombre'
        ]);

        $dataToUpdate = $request->all();
        $ingrediente->update($dataToUpdate);

        return response()->json(['success' => true, 'data' => $ingrediente]);
    }

    // Elimina el ingredeiente por id
    public function destroy($id)
    {

        $ingrediente = ingrediente::find($id);

        $ingrediente->delete();

        return response()->json(['success' => true, 'data' => 'Ingrediente eliminado correctamente']);
    }


    
}
