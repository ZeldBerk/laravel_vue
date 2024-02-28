<?php

namespace Database\Seeders;

use App\Models\categorias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateCategorias extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $categoria1 = categorias::create([
        //    'nombre' => 'Primeros' 
        // ]);

        // $categoria2 = categorias::create([
        //     'nombre' => 'Segundos'
        // ]);

        // $categoria3 = categorias::create([
        //     'nombre' => 'Postres'
        // ]);

        $categorias = [
            'Primeros',
            'Segundos',
            'Postres'
        ];

        foreach ($categorias as $categoria) {
            categorias::create(['nombre' => $categoria]);
        }
    }
}
