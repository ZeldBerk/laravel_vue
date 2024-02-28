<?php

namespace Database\Seeders;

use App\Models\recetas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateRecetas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $receta1 = recetas::create([
            'nombre' => 'croquetas',
            'descripcion' => 'pideselas a la yaya',
            'ruta_imagen' => 'croquetas.png', 
            'racciones' => 1,
            'tiempo_preparacion' => '120',
            'user_id' => 1,
            'categoria_id' => 1
        ]);

        $receta1 = recetas::create([
            'nombre' => 'Tarta queso',
            'descripcion' => 'en know eats',
            'ruta_imagen' => 'tartadequeso.png', 
            'racciones' => 4,
            'tiempo_preparacion' => '200',
            'user_id' => 1,
            'categoria_id' => 3
        ]);

        $receta1 = recetas::create([
            'nombre' => 'pollo',
            'descripcion' => 'Filetear el pollo y a la plancha',
            'ruta_imagen' => 'pollo.png', 
            'racciones' => 2,
            'tiempo_preparacion' => '10',
            'user_id' => 1,
            'categoria_id' => 2
        ]);
    }
}
