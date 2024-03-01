<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Favoritos;
use Illuminate\Http\Request;

class FavoritosController extends Controller
{

    public function index($user_id){
        $favoritos = Favoritos::where('user_id', $user_id)->get();

        if ($favoritos->isEmpty()) {
            // Puedes personalizar la respuesta si no se encuentran objetos
            return response()->json(['mensaje' => 'No se encontraron objetos'], 404);
        }
    
        // Devuelve los objetos como respuesta
        return response()->json($favoritos);
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
