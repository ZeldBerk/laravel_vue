<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\comentarios;

class ComentariosRecetas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        comentarios::create([
            'user_id' => 2,
            'receta_id' => 2,
            'contenido' => 'No me gustó para nada esta receta de tarta de queso. 
            La encontré demasiado pesada y poco sabrosa. No la volveré a hacer.',
            'puntuacion' => 1
        ]);

        comentarios::create([
            'user_id' => 3,
            'receta_id' => 2,
            'contenido' => 'La tarta de queso estuvo bien, pero no fue nada del 
            otro mundo. La textura era un poco densa para mi gusto.',
            'puntuacion' => 2
        ]);

        comentarios::create([
            'user_id' => 4,
            'receta_id' => 2,
            'contenido' => 'La tarta de queso estuvo decente. Tenía un buen sabor, 
            pero encontré que le faltaba algo de dulzura.',
            'puntuacion' => 3
        ]);

        comentarios::create([
            'user_id' => 5,
            'receta_id' => 2,
            'contenido' => 'Me gustó esta receta de tarta de queso. La textura 
            era suave y cremosa, y el sabor era agradable.',
            'puntuacion' => 4
        ]);

        comentarios::create([
            'user_id' => 6,
            'receta_id' => 2,
            'contenido' => '¡Increíble! Esta receta de tarta de queso es perfecta 
            en todos los sentidos. La textura es suave y cremosa, el sabor es delicioso.',
            'puntuacion' => 5
        ]);
    }
}
