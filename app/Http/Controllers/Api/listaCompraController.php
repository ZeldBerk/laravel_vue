<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ingredientes_recetas;
use App\Models\planSemanal;
use Illuminate\Http\Request;

class listaCompraController extends Controller
{
    public function listaCompra(Request $request, int $userId, string $formato)
    {
        $recetasSemanales = PlanSemanal::where('user_id', $userId)->get();

        $listaCompra = [];

        foreach ($recetasSemanales as $receta) {
            // Verificar si la fecha de elaboración está definida
            if ($receta->fecha_elaboracion) {
                $diaReceta = $receta->fecha_elaboracion->format('Y-m-d');
                $ingredientesReceta = ingredientes_recetas::where('receta_id', $receta->receta_id)
                    ->join('ingredientes', 'ingredientes_recetas.ingrediente_id', '=', 'ingredientes.id')
                    ->select('ingredientes.nombre', 'ingredientes_recetas.cantidad', 'ingredientes_recetas.unidad')
                    ->get();

                foreach ($ingredientesReceta as $ingrediente) {
                    if ($formato == 'dia') {
                        if (!isset($listaCompra[$diaReceta][$ingrediente->nombre])) {
                            $listaCompra[$diaReceta][$ingrediente->nombre] = [
                                'cantidad' => 0,
                                'unidad' => $ingrediente->unidad,
                            ];
                        }
                        $listaCompra[$diaReceta][$ingrediente->nombre]['cantidad'] += $ingrediente->cantidad;
                    } else {
                        if (!isset($listaCompra[$ingrediente->nombre])) {
                            $listaCompra[$ingrediente->nombre] = [
                                'cantidad' => 0,
                                'unidad' => $ingrediente->unidad,
                            ];
                        }
                        $listaCompra[$ingrediente->nombre]['cantidad'] += $ingrediente->cantidad;
                    }
                }
            }
        }

        return response()->json($listaCompra);
    }
}
