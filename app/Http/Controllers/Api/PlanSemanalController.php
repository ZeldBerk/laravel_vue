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
            'dia_semana' => 'required'
        ]);

        
    }
}
