<?php

namespace Database\Seeders;

use App\Models\ingrediente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateIngredientes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $adding = ingrediente::create([
            'nombre' => 'Añadir ingrediente...'
        ]);

        $ingredientes = [
            'Harina',
            'Azúcar',
            'Huevos',
            'Leche',
            'Jamón Serrano',
            'Sal',
            'Aceite de Oliva',
            'Pan rallado',
            'Mantequilla',
            'Nuez moscada',
            'Pan',
            'Canela en rama',
            'Ralladura de Limon',
            'Canela',
            'Queso crema',
            'Nata',
            'Patatas',
            'Pimienta Negra',
            'Cebolla',
            'Diente de ajo',
            'Pollo',
            'Vino blanco',
            'Rama de Romero',
            'Pimiento Rojo',
            'Pimenton Dulce',
            'Atún en lata',
            'Agua',
            'Berenjena',
            'Zanahoria',
            'Carne picada de Cerdo',
            'Carne picada de Ternera',
            'Tomates',
            'Queso rallado',
            'Manojo de Perejil',
            'Guanciale',
            'Yemas de huevo',
            'Queso Pecorino rallado',
            'Pasta'
        ];
        
        foreach ($ingredientes as $ingrediente){
            ingrediente::create(['nombre' => $ingrediente]);
        }
      
    }
}
