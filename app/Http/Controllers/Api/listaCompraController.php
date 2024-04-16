<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ingredientes_recetas;
use App\Models\planSemanal;
use Illuminate\Http\Request;

class listaCompraController extends Controller
{
    public function listaCompra(int $userId, string $formato)
    {
        $recetasSemanales = PlanSemanal::where('user_id', $userId)->get();

        $listaCompra = [];

        foreach ($recetasSemanales as $receta) {
            // Verificar si el formato es diario o semanal
            if ($formato === 'semana') {
                // Si es semanal, no necesitamos el día de la semana
                $diaSemana = null;
            } else {
                // Si es diario, extraemos el día de la semana
                $diaSemana = $receta->dia_semana;
            }

            // Extraer el ID de receta
            $recetaId = $receta->receta_id;

            // Buscar los ingredientes correspondientes a la receta en la base de datos
            $ingredientesReceta = ingredientes_recetas::where('receta_id', $recetaId)
                ->join('ingredientes', 'ingredientes_recetas.ingrediente_id', '=', 'ingredientes.id')
                ->select('ingredientes.nombre', 'ingredientes_recetas.cantidad', 'ingredientes_recetas.unidad')
                ->get();

            // Agregar los ingredientes a la lista de compras
            foreach ($ingredientesReceta as $ingrediente) {
                if (!isset($listaCompra[$diaSemana][$ingrediente->nombre])) {
                    $listaCompra[$diaSemana][$ingrediente->nombre] = [
                        'nombre' => $ingrediente->nombre,
                        'cantidad' => 0,
                        'unidad' => $ingrediente->unidad,
                    ];
                }

                $listaCompra[$diaSemana][$ingrediente->nombre]['cantidad'] += $ingrediente->cantidad;
            }
        }

        // Convertir unidades si es necesario
        foreach ($listaCompra as &$diaCompra) {
            foreach ($diaCompra as &$ingrediente) {
                if ($ingrediente['unidad'] === 'g' && $ingrediente['cantidad'] > 1000) {
                    $ingrediente['cantidad'] = round($ingrediente['cantidad'] / 1000, 2);
                    $ingrediente['unidad'] = 'Kg';
                } elseif ($ingrediente['unidad'] === 'ml' && $ingrediente['cantidad'] > 1000) {
                    $ingrediente['cantidad'] = round($ingrediente['cantidad'] / 1000, 2);
                    $ingrediente['unidad'] = 'L';
                }
            }
        }

        return response()->json($listaCompra);
    }
}
