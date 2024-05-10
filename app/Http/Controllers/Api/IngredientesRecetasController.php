<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\recetas; 
use Illuminate\Support\Facades\DB;

class IngredientesRecetasController extends Controller
{
    // Recibe un ingrediente con el id de receta al que va asignado y genera el registro
    public function storeInReceta(Request $request)
    {

        $request->validate([
            'receta_id' => 'required',
            'ingredientes' => 'required|array',
            'ingredientes.*.ingrediente_id' => 'required',
            'ingredientes.*.cantidad' => 'required',
            'ingredientes.*.unidad' => 'required',
        ]);


        $receta = recetas::findOrFail($request->receta_id);
        $ingredientes = $request->ingredientes;

        // Sincroniza los ingredientes de la receta con los proporcionados en la solicitud
        $receta->ingredientes()->sync($ingredientes);


        return response()->json(['success' => true, 'data' => 'Ingredientes de la receta sincronizados correctamente']);
    }

    // Obtiene todos los ingredientes de una receta
    public function show($id)
    {

        $ingredientes = DB::table('ingredientes_recetas')
            ->join('ingredientes', 'ingredientes_recetas.ingrediente_id', '=', 'ingredientes.id')
            ->where('ingredientes_recetas.receta_id', $id)
            ->select('ingredientes.nombre', 'ingredientes_recetas.cantidad', 'ingredientes_recetas.unidad')
            ->get();


        return response()->json($ingredientes);
    }

    // Agrega un ingrediente a la receta
    public function updateIngReceta($receta_id, $ingrediente_id)
    {
        
        $receta = recetas::find($receta_id);
        
        // Adjunta el ingrediente a la receta
        $receta->ingredientes()->attach($ingrediente_id);


        return response()->json(['success' => true, 'data' => 'Ingrediente añadido a la receta correctamente']);
    }

    // Elimina un ingrediente de una receta
    public function deleteIngreReceta($receta_id, $ingrediente_id)
    {

        $receta = recetas::find($receta_id);
        
        // Elimina el ingrediente de la receta
        $receta->ingredientes()->detach($ingrediente_id);

    
        return response()->json(['success' => true, 'data' => 'Ingrediente eliminado de la receta correctamente']);
    }
}
