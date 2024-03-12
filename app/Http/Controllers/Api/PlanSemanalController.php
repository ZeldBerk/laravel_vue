<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\planSemanal;
use App\Models\recetas;
use Illuminate\Http\Request;

class PlanSemanalController extends Controller
{
    public function index($user_id){
        $recetasSemana = planSemanal::where('user_id', $user_id)->get();

        $plan = [];

        foreach($recetasSemana as $receta){
            $receta = recetas::find($receta->receta_id);

            $plan[] = $receta;
        }

        return response()->json($plan);
    }

    public function store(Request $request){
        $request->validate([
            'user_id' => 'required',
            'receta_id' => 'required',
            'dia_semana' => 'required',
            'momento_dia' => 'required'
        ]);

        //Validacion extra para asegurar que una receta no puede estar en el mismo dia en el mismo momento del dia (comida o cena)
        $existe = planSemanal::where('user_id', $request->user_id)->
            where('receta_id', $request->receta_id)->
            where('momento_dia', $request->momento_dia)->exists();
            
            if($existe){
                return response()->json(['success' => false, 'message' => 'Esta receta ya esta añadida para este momento del dia']);
            }

            $recetaPlan = $request->all();
            $receta = planSemanal::create($recetaPlan);

            return response()->json(['success' => true, 'data' => 'La receta ha sido añadida correctamente a tu plan']);
        
    }

    public function destroy(Request $request){
        
    }
}
