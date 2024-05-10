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
            'ingredientes.*.ingrediente_id' => 'required',
            'ingredientes.*.cantidad' => 'required',
            'ingredientes.*.unidad' => 'required',
        ]);

        DB::table('ingredientes_recetas')->insert([
            'receta_id' => $request->receta_id,
            'ingrediente_id' => $request->ingrediente_id,
            'cantidad' => $request->cantidad,
            'unidad' => $request->unidad,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $receta = recetas::findOrFail($request->receta_id);
        $ingredientes = $request->ingrediente_id;

        // Sincroniza los ingredientes de la receta con los proporcionados en la solicitud
        $receta->ingredientes()->syncWithoutDetaching($ingredientes);


        return response()->json(['success' => true, 'data' => 'Ingredientes de la receta sincronizados correctamente']);
    }

    // Obtiene todos los ingredientes de una receta
    public function show($id)
    {

        $ingredientes = DB::table('ingredientes_recetas')
            ->join('ingredientes', 'ingredientes_recetas.ingrediente_id', '=', 'ingredientes.id')
            ->where('ingredientes_recetas.receta_id', $id)
            ->select('ingredientes_recetas.id', 'ingredientes.nombre', 'ingredientes_recetas.cantidad', 'ingredientes_recetas.unidad')
            ->get();


        return response()->json($ingredientes);
    }

    // Agrega un ingrediente a la receta
    public function updateIngReceta($ingrediente_receta_id, Request $request)
    {

        $request->validate([
            'cantidad' => 'required',
            'unidad' => 'required',
        ]);

        // Encontrar la relación ingrediente_receta en la tabla intermedia
        $ingrediente_receta = DB::table('ingredientes_recetas')
            ->where('id', $ingrediente_receta_id)
            ->first();

        // Verificar si la relación ingrediente_receta existe
        if (!$ingrediente_receta) {
            return response()->json(['success' => false, 'message' => 'La relación ingrediente_receta no existe'], 404);
        }

        // Actualizar la cantidad y la unidad del ingrediente en la relación ingrediente_receta
        DB::table('ingredientes_recetas')
            ->where('id', $ingrediente_receta_id)
            ->update([
                'cantidad' => $request->cantidad,
                'unidad' => $request->unidad,
                'updated_at' => now(), 
            ]);

        return response()->json(['success' => true, 'data' => 'Ingrediente actualizado correctamente en la receta']);
    }


    // Elimina un ingrediente de una receta
    public function deleteIngreReceta($ingrediente_receta_id)
    {

        $ingrediente_receta = DB::table('ingredientes_recetas')
            ->where('id', $ingrediente_receta_id)
            ->first();

        // Verificar si la relación ingrediente_receta existe
        if (!$ingrediente_receta) {
            return response()->json(['success' => false, 'message' => 'La relación ingrediente_receta no existe'], 404);
        }

        // Eliminar la relación ingrediente_receta
        DB::table('ingredientes_recetas')
            ->where('id', $ingrediente_receta_id)
            ->delete();

        return response()->json(['success' => true, 'data' => 'Ingrediente eliminado de la receta correctamente']);
    }
}
