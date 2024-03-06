<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Favoritos;
use App\Models\recetas;
use Illuminate\Http\Request;

class FavoritosController extends Controller
{

    public function index($user_id){
        $favoritos = Favoritos::where('user_id', $user_id)->get();

        $recetas = [];
        
        foreach ($favoritos as $favorito) {
          // Obtener la información de la receta
          $receta = recetas::find($favorito->receta_id);
        
          // Agregar la receta al array de resultados
          $recetas[] = $receta;
        }
        
        // Devuelve las recetas como respuesta
        return response()->json($recetas);
        
    }

    public function store(Request $request)
{
    // Validación original
    $request->validate([
        'userId' => 'required',
        'recetaId' => 'required',
    ]);

    // Validación adicional: comprobar si la receta ya es favorita
    $existeFavorito = Favoritos::where('user_id', $request->userId)
        ->where('receta_id', $request->recetaId)
        ->exists();

    if ($existeFavorito) {
        return response()->json(['success' => false, 'message' => 'La receta ya está en tus favoritos.']);
    }

    // Si la receta no es favorita, se crea el nuevo registro
    $favorito = $request->all();
    $fav = Favoritos::create($favorito);

    return response()->json(['success' => true, 'data' => $fav]);
}


    public function destroy($id){
        $favorito = Favoritos::find($id);

        $favorito->delete();

        return response()->json(['success' => true, 'data' => 'Receta eliminada de Favoritos']);
    }
}
