<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Favoritos;
use App\Models\recetas;
use Illuminate\Http\Request;
use App\Models\User;

class FavoritosController extends Controller
{

  //Obtener todas las recetas favoritas del usuario
  public function index($user_id)
  {
    $favoritos = Favoritos::where('user_id', $user_id)->get();

    $recetas = [];

    foreach ($favoritos as $favorito) {
      $receta = recetas::with('media')->find($favorito->receta_id);

      $recetas[] = $receta;
    }

    return response()->json($recetas);
  }

//Guardar receta en favoritos
public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required',
        'receta_id' => 'required',
    ]);

    $user = User::find($request->user_id);
    $user->favoritas()->syncWithoutDetaching([$request->receta_id]);

    return response()->json(['success' => true, 'data' => 'La receta se ha añadido correctamente a Favoritos']);
}


  // Eliminar receta de Favoritos 
  public function destroy(Request $request, $receta_id)
  {
    $userId = $request->user()->id;


    $favorito = Favoritos::where('receta_id', $receta_id)->where('user_id', $userId)->first();

    if (!$favorito) {
      return response()->json(['success' => false, 'error' => 'No se encontró la receta en favoritos'], 404);
    }


    $favorito->delete();


    return response()->json(['success' => true, 'data' => 'Receta eliminada de Favoritos']);
  }
}
