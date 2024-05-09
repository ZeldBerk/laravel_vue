<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\planSemanal;
use Illuminate\Http\Request;

class PlanSemanalController extends Controller
{
    //Obtener el plan semanal del usuario 
    public function index($user_id)
    {
        $plan = PlanSemanal::with('receta')
            ->where('user_id', $user_id)
            ->get();

        return response()->json($plan);
    }



    //Guardar recetas en el plan semanal 
    public function store(Request $request)
    {

        $request->validate([
            'user_id' => 'required',
            'receta_id' => 'required',
            'dia_semana' => 'required',
            'momento_dia' => 'required'
        ]);

        // Validar si existen más de tres recetas en el mismo día y momento del día
        $numeroRecetas = PlanSemanal::where('user_id', $request->user_id)
            ->where('dia_semana', $request->dia_semana)
            ->where('momento_dia', $request->momento_dia)
            ->count();

        if ($numeroRecetas >= 3) {
            return response()->json(['success' => false, 'message' => 'Ya existen tres recetas con el mismo día y momento del día']);
        }

        // Validar si la receta ya está asignada para el mismo día y momento del día
        $existeReceta = PlanSemanal::where('user_id', $request->user_id)
            ->where('dia_semana', $request->dia_semana)
            ->where('momento_dia', $request->momento_dia)
            ->where('receta_id', $request->receta_id)
            ->exists();

        if ($existeReceta) {
            return response()->json(['success' => false, 'message' => 'La receta ya está asignada para el mismo día y momento del día']);
        }

        // Si pasa todas las validaciones, crear el plan semanal
        $recetaPlan = $request->all();
        $receta = PlanSemanal::create($recetaPlan);

        return response()->json(['success' => true, 'data' => 'La receta ha sido añadida correctamente a tu plan']);
    }


    //Elimnar receta del plan semanal
    public function destroy(Request $request, $id)
    {
        $idUser = $request->user()->id;

        $receta = PlanSemanal::where('id', $id);

        if (!$receta) {
            return response()->json(['success' => false, 'error' => 'No se encontro ninguna receta en el plan']);
        }

        $receta->delete();

        return response()->json(['success' => true, 'data' => 'Receta eliminada del Plan Semanal']);
    }
}
