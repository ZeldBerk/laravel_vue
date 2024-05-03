<?php

namespace Database\Seeders;

use App\Models\ingredientes_recetas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientesRecetas extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $ingredientes1 = [
      [
        'ingrediente_id' => 6,
        'cantidad' => 200,
        'unidad' => 'g',
      ],
      [
        'ingrediente_id' => 7,
        'cantidad' => null,
        'unidad' => null
      ],
      [
        'ingrediente_id' => 8,
        'cantidad' => 5,
        'unidad' => 'ml',
      ],
      [
        'ingrediente_id' => 4,
        'cantidad' => 3,
        'unidad' => 'unidades',
      ],
      [
        'ingrediente_id' => 2,
        'cantidad' => 110,
        'unidad' => 'g'
      ],
      [
        'ingrediente_id' => 9,
        'cantidad' => null,
        'unidad' => null
      ],
      [
        'ingrediente_id' => 5,
        'cantidad' => 1,
        'unidad' => 'L'
      ],
      [
        'ingrediente_id' => 10,
        'cantidad' =>  110,
        'unidad' => 'g'
      ],
      [
        'ingrediente_id' => 11,
        'cantidad' => 1,
        'unidad' => 'unidades'
      ]
    ];

    foreach ($ingredientes1 as $ing1) {
      ingredientes_recetas::create([

        'receta_id' => 1,
        'ingrediente_id' => $ing1['ingrediente_id'],
        'cantidad' => $ing1['cantidad'],
        'unidad' => $ing1['unidad']
      ]);
    }

    $ingredientes2 = [
      [
        'ingrediente_id' => 16,
        'cantidad' => 570,
        'unidad' => 'g'
      ],
      [
        'ingrediente_id' => 4,
        'cantidad' => 4,
        'unidad' => 'unidades'
      ],
      [
        'ingrediente_id' => 3,
        'cantidad' => 230,
        'unidad' => 'g'
      ],
      [
        'ingrediente_id' => 2,
        'cantidad' => 10,
        'unidad' => 'g'
      ],
      [
        'ingrediente_id' => 17,
        'cantidad' => 285,
        'unidad' => 'ml'
      ],
    ];

    foreach ($ingredientes2 as $ing2) {
      ingredientes_recetas::create([

        'receta_id' => 2,
        'ingrediente_id' => $ing2['ingrediente_id'],
        'cantidad' => $ing2['cantidad'],
        'unidad' => $ing2['unidad']
      ]);
    }


    $ingredientes3 = [
      [
        'ingrediente_id' => 18,
        'cantidad' => 4,
        'unidad' => 'unidades'
      ],
      [
        'ingrediente_id' => 8,
        'cantidad' => 30,
        'unidad' => 'ml'
      ],
      [
        'ingrediente_id' => 7,
        'cantidad' => null,
        'unidad' => null
      ],
      [
        'ingrediente_id' => 19,
        'cantidad' => null,
        'unidad' => null
      ],
      [
        'ingrediente_id' => 20,
        'cantidad' => 1,
        'unidad' => 'unidades'
      ],
      [
        'ingrediente_id' => 21,
        'cantidad' => 6,
        'unidad' => 'unidades'
      ],
      [
        'ingrediente_id' => 22,
        'cantidad' => 1.2,
        'unidad' => 'kg'
      ],
      [
        'ingrediente_id' => 23,
        'cantidad' => 200,
        'unidad' => 'ml'
      ],
      [
        'ingrediente_id' => 24,
        'cantidad' => 1,
        'unidad' => 'unidades'
      ],

    ];

    foreach ($ingredientes3 as $ing3) {
      ingredientes_recetas::create([

        'receta_id' => 3,
        'ingrediente_id' => $ing3['ingrediente_id'],
        'cantidad' => $ing3['cantidad'],
        'unidad' => $ing3['unidad']
      ]);
    }

    $ingredientes4 = [
      [
        'ingrediente_id' => 12,
        'cantidad' => 20,
        'unidad' => 'unidades'
      ],
      [
        'ingrediente_id' => 5,
        'cantidad' => 1,
        'unidad' => 'L'
      ],
      [
        'ingrediente_id' => 3,
        'cantidad' => 100,
        'unidad' => 'g'
      ],
      [
        'ingrediente_id' => 13,
        'cantidad' => 1,
        'unidad' => 'unidades'
      ],
      [
        'ingrediente_id' => 8,
        'cantidad' => 1,
        'unidad' => 'L'
      ],
      [
        'ingrediente_id' => 4,
        'cantidad' => 2,
        'unidad' => 'unidades'
      ],
      [
        'ingrediente_id' => 14,
        'cantidad' => null,
        'unidad' => null
      ],
      [
        'ingrediente_id' => 15,
        'cantidad' => null,
        'unidad' => null
      ],
    ];

    foreach ($ingredientes4 as $ing4) {
      ingredientes_recetas::create([

        'receta_id' => 4,
        'ingrediente_id' => $ing4['ingrediente_id'],
        'cantidad' => $ing4['cantidad'],
        'unidad' => $ing4['unidad']
      ]);
    }

    $ingredientes5 = [
      [
        'ingrediente_id' => 18,
        'cantidad' => 300,
        'unidad' => 'g'
      ],
      [
        'ingrediente_id' => 20,
        'cantidad' => 100,
        'unidad' => 'g'
      ],
      [
        'ingrediente_id' => 8,
        'cantidad' => 300,
        'unidad' => 'ml'
      ],
      [
        'ingrediente_id' => 7,
        'cantidad' => null,
        'unidad' => null
      ],
      [
        'ingrediente_id' => 4,
        'cantidad' => 4,
        'unidad' => 'unidades'
      ],
    ];

    foreach ($ingredientes5 as $ing5) {
      ingredientes_recetas::create([

        'receta_id' => 5,
        'ingrediente_id' => $ing5['ingrediente_id'],
        'cantidad' => $ing5['cantidad'],
        'unidad' => $ing5['unidad']
      ]);
    }

    $ingredientes6 = [
      [
        'ingrediente_id' => 20,
        'cantidad' => 300,
        'unidad' => 'g'
      ],
      [
        'ingrediente_id' => 25,
        'cantidad' => 0.5,
        'unidad' => 'unidades'
      ],
      [
        'ingrediente_id' => 8,
        'cantidad' => 200,
        'unidad' => 'ml'
      ],
      [
        'ingrediente_id' => 26,
        'cantidad' => 7,
        'unidad' => 'g'
      ],
      [
        'ingrediente_id' => 27,
        'cantidad' => 250,
        'unidad' => 'g'
      ],
      [
        'ingrediente_id' => 2,
        'cantidad' => 300,
        'unidad' => 'g'
      ],
      [
        'ingrediente_id' => 28,
        'cantidad' => 120,
        'unidad' => 'ml'
      ],
      [
        'ingrediente_id' => 4,
        'cantidad' => 1,
        'unidad' => 'unidades'
      ],
    ];

    foreach ($ingredientes6 as $ing6) {
      ingredientes_recetas::create([

        'receta_id' => 6,
        'ingrediente_id' => $ing6['ingrediente_id'],
        'cantidad' => $ing6['cantidad'],
        'unidad' => $ing6['unidad']
      ]);
    }

    $ingredientes7 = [
      [
        'ingrediente_id' => 29,
        'cantidad' => 2,
        'unidad' => 'unidades'
      ],
      [
        'ingrediente_id' => 7,
        'cantidad' => null,
        'unidad' => null
      ],
      [
        'ingrediente_id' => 19,
        'cantidad' => null,
        'unidad' => null
      ],
      [
        'ingrediente_id' => 8,
        'cantidad' => 30,
        'unidad' => 'ml'
      ],
      [
        'ingrediente_id' => 20,
        'cantidad' => 1,
        'unidad' => 'unidades'
      ],
      [
        'ingrediente_id' => 21,
        'cantidad' => 2,
        'unidad' => 'unidades'
      ],
      [
        'ingrediente_id' => 30,
        'cantidad' => 2,
        'unidad' => 'unidades'
      ],
      [
        'ingrediente_id' => 31,
        'cantidad' => 200,
        'unidad' => 'g'
      ],
      [
        'ingrediente_id' => 32,
        'cantidad' => 200,
        'unidad' => 'g'
      ],
      [
        'ingrediente_id' => 33,
        'cantidad' => 2,
        'unidad' => 'unidades'
      ],
      [
        'ingrediente_id' => 23,
        'cantidad' => 100,
        'unidad' => 'ml'
      ],
      [
        'ingrediente_id' => 10,
        'cantidad' => 50,
        'unidad' => 'g'
      ],
      [
        'ingrediente_id' => 5,
        'cantidad' => 500,
        'unidad' => 'ml'
      ],
      [
        'ingrediente_id' => 34,
        'cantidad' => 50,
        'unidad' => 'g'
      ],
      [
        'ingrediente_id' => 35,
        'cantidad' => 1,
        'unidad' => 'unidades'
      ],
    ];

    foreach ($ingredientes7 as $ing7) {
      ingredientes_recetas::create([

        'receta_id' => 7,
        'ingrediente_id' => $ing7['ingrediente_id'],
        'cantidad' => $ing7['cantidad'],
        'unidad' => $ing7['unidad']
      ]);
    }

    $ingredientes8 = [
      [
        'ingrediente_id' => 36,
        'cantidad' => 30,
        'unidad' => 'g'
      ],
      [
        'ingrediente_id' => 37,
        'cantidad' => 2,
        'unidad' => 'unidades'
      ],
      [
        'ingrediente_id' => 38,
        'cantidad' => 25,
        'unidad' => 'g'
      ],
      [
        'ingrediente_id' => 39,
        'cantidad' => 100,
        'unidad' => 'g'
      ],[
        'ingrediente_id' => 7,
        'cantidad' => null,
        'unidad' => null
      ],[
        'ingrediente_id' => 19,
        'cantidad' => null,
        'unidad' => null
      ],
    ];

    foreach ($ingredientes8 as $ing8) {
      ingredientes_recetas::create([

        'receta_id' => 8,
        'ingrediente_id' => $ing8['ingrediente_id'],
        'cantidad' => $ing8['cantidad'],
        'unidad' => $ing8['unidad']
      ]);
    }
  }
}
