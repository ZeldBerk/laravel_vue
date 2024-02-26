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
        $Harina = ingrediente::create([
           'nombre' => 'Harina'
        ]);

        $azucar = ingrediente::create([
            'nombre' => 'Azúcar'
        ]);

        $huevos = ingrediente::create([
            'nombre' => 'Huevos'
        ]);

        $leche = ingrediente::create([
            'nombre' => 'Leche'
        ]);
    }
}
