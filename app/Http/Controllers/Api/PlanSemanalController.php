<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\planSemanal;
use App\Models\recetas;
use Illuminate\Http\Request;

class PlanSemanalController extends Controller
{
    public function index($user_id){
        $plan = PlanSemanal::with('receta')
            ->where('user_id', $user_id)
            ->get();

        return response()->json($plan);
    }




    public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required',
        'receta_id' => 'required',
        'dia_semana' => 'required',
        'momento_dia' => 'required'
    ]);

    // Validacion extra para asegurar que una receta no puede estar en el mismo dia y momento del dia (comida o cena)
    $existe = PlanSemanal::where('user_id', $request->user_id)
        ->where('dia_semana', $request->dia_semana)
        ->where('momento_dia', $request->momento_dia)
        ->where('receta_id', $request->receta_id)
        ->limit(3)
        ->exists();

    if ($existe) {
        return response()->json(['success' => false, 'message' => 'Ya existen tres recetas con el mismo día, momento del día o receta']);
    }

    $recetaPlan = $request->all();
    $receta = PlanSemanal::create($recetaPlan);

    return response()->json(['success' => true, 'data' => 'La receta ha sido añadida correctamente a tu plan']);
}


    public function destroy(Request $request, $id){
        $idUser = $request->user()->id;

        $receta = PlanSemanal::where('id', $id);

        if(!$receta){
            return response()->json(['success' => false, 'error' => 'No se encontro ninguna receta en el plan']);
        }

        $receta->delete();

        return response()->json(['success' => true, 'data' => 'Receta eliminada del Plan Semanal']);

        
    }
}
