<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\planSemanal;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PlanSemanalController extends Controller
{
    // Método para obtener el plan semanal del usuario
    public function index($user_id)
    {

        $plan = DB::table('plan_semanals')
            ->join('recetas', 'plan_semanals.receta_id', '=', 'recetas.id')
            ->select('plan_semanals.*', 'recetas.*')
            ->where('plan_semanals.user_id', $user_id)
            ->get();

        return response()->json($plan);
    }

    // Método para guardar una receta en el plan semanal
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'receta_id' => 'required',
            'dia_semana' => 'required',
            'momento_dia' => 'required'
        ]);


        $numeroRecetas = DB::table('plan_semanals')
            ->where('user_id', $request->user_id)
            ->where('dia_semana', $request->dia_semana)
            ->where('momento_dia', $request->momento_dia)
            ->count();

        // Verificar si ya hay tres recetas para el mismo día y momento del día
        if ($numeroRecetas >= 3) {
            return response()->json(['success' => false, 'message' => 'Ya existen tres recetas con el mismo día y momento del día']);
        }

        // Verificar si la receta ya está asignada para el mismo día y momento del día
        $existeReceta = DB::table('plan_semanals')
            ->where('user_id', $request->user_id)
            ->where('dia_semana', $request->dia_semana)
            ->where('momento_dia', $request->momento_dia)
            ->where('receta_id', $request->receta_id)
            ->exists();

      
        if ($existeReceta) {
            return response()->json(['success' => false, 'message' => 'La receta ya está asignada para el mismo día y momento del día']);
        }

        // Si pasa todas las validaciones, crear el plan semanal y sincronizar la receta al plan semanal del usuario
        DB::table('plan_semanals')->insert([
            'user_id' => $request->user_id,
            'receta_id' => $request->receta_id,
            'dia_semana' => $request->dia_semana,
            'momento_dia' => $request->momento_dia,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user = User::find($request->user_id);
        $user->planSemanal()->syncWithoutDetaching([$request->receta_id]);

        return response()->json(['success' => true, 'data' => 'La receta ha sido añadida correctamente a tu plan']);
    }

    // Método para eliminar una receta del plan semanal
    public function destroy(Request $request, $receta_id)
    {

        $user = $request->user();

        // Desasociar la receta del plan semanal del usuario
        $user->planSemanal()->detach($receta_id);

        return response()->json(['success' => true, 'data' => 'Receta eliminada del Plan Semanal']);
    }
}
