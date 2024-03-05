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

    public function store(Request $request){

        $request->validate([
            'user_id' => 'required',
            'receta_id' => 'required'
        ]);

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
