<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Favoritos;
use App\Models\recetas;
use Illuminate\Http\Request;

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


    $existeFavorito = Favoritos::where('user_id', $request->user_id)
      ->where('receta_id', $request->receta_id)
      ->exists();

    if ($existeFavorito) {
      return response()->json(['success' => false, 'message' => 'La receta ya está en tus favoritos.']);
    }


    $favorito = $request->all();
    $fav = Favoritos::create($favorito);

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
