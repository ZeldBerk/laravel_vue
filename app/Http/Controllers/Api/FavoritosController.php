<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class FavoritosController extends Controller
{
    // Obtener todas las recetas favoritas del usuario
    public function index($user_id)
    {
        $user = User::findOrFail($user_id);

        // Obtenemos todas las recetas favoritas del usuario con los archivos multimedia asociados
        $recetas = $user->favoritas()->with('media')->get();
        
        return response()->json($recetas);
    }

    // Guardar receta en favoritos
    public function store(Request $request)
    {

        $request->validate([
            'user_id' => 'required',
            'receta_id' => 'required',
        ]);


        $user = User::findOrFail($request->user_id);
        
        // Agregamos la receta a los favoritos del usuario sin eliminar otras relaciones existentes
        $user->favoritas()->syncWithoutDetaching([$request->receta_id]);

        return response()->json(['success' => true, 'data' => 'La receta se ha añadido correctamente a Favoritos']);
    }

    // Eliminar receta de Favoritos
    public function destroy(Request $request, $receta_id)
    {

        $user = $request->user();
        
        // Eliminamos la relación entre la receta y el usuario
        if (!$user->favoritas()->detach($receta_id)) {
            
            return response()->json(['success' => false, 'error' => 'No se encontró la receta en favoritos'], 404);
        }


        return response()->json(['success' => true, 'data' => 'Receta eliminada de Favoritos']);
    }
}
