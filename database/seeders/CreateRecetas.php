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
            'nombre' => 'Croquetas de Jamón',
            'descripcion_corta' => 'Deliciosas croquetas de jamón, crujientes por fuera y cremosas por dentro.',
            'descripcion' => 'Ponemos en una sartén honda la mantequilla fundida y la harina para preparar la bechamel
            Cocinamos la harina con la mantequilla y añadimos poco a poco la leche caliente
            Salpimentamos la bechamel y le añadimos nuez moscada recién rallada
            Añadimos el jamón serrano en tacos pequeños
            Vertemos la masa de las croquetas sobre un molde cuadrado y lo llevamos a la nevera
            Cortamos la masa en pociones
            Formamos las croquetas y las pasamos por huevo y pan rallado
            Llevamos las croquetas a enfriar a la nevera y después las freímos en tandas pequeñas
            Servimos las croquetas calientes',
            'raciones' => 6,
            'tiempo_preparacion' => '360',
            'user_id' => 1,
            'categoria_id' => 1
        ]);
        $receta1->addMedia(public_path('imagesSeeder/Croquetas.jpeg'))->preservingOriginal()->toMediaCollection('photo');
        

        $receta2 = recetas::create([
            'nombre' => 'Tarta de Queso',
            'descripcion_corta' => 'Una tentadora tarta de queso cremosa y llena de sabor, ¡irresistible!',
            'descripcion' => 'Precalentamos el horno a 200 ºC, ponemos en un bol el queso crema y añadimos los huevos de uno en uno
            Removemos e integramos la mezcla
            Añadimos el azúcar e integramos
            Añadimos la harina y de nuevo integramos siempre con unas varillas
            Finalmente, añadimos la nata e integramos de nuevo
            Forramos un molde con papel vegetal humedecido
            Vertemos la mezcla en el molde con el papel
            Horneamos a 200 ºC durante 40 minutos
            Retiramos la tarta de queso La Viña del horno, la dejamos atemperar para que adquiera la textura adecuada y la servimos
            ',
            'raciones' => 4,
            'tiempo_preparacion' => '50',
            'user_id' => 1,
            'categoria_id' => 3
        ]);
        $receta2->addMedia(public_path('imagesSeeder/tartaQueso.jpeg'))->preservingOriginal()->toMediaCollection('photo');

        $receta3 = recetas::create([
            'nombre' => 'Pollo al Horno',
            'descripcion_corta' => 'Pollo jugoso y aromático, acompañado de patatas doradas y sabrosas.',
            'descripcion' => 'Pelamos, lavamos y cortamos en rodajas las patatas
            Las salpimentamos, las ponemos sobre una bandeja de horno engrasada y añadimos la cebolla y los ajos
            Salpimentamos las piezas de pollo
            Ponemos el pollo sobre la cama de patatas, vertemos el vino y añadimos el romero
            Asamos el pollo con las patatas 45 minutos a 200 ºC y giramos las piezas
            Devolvemos el pollo al horno para hornearlo otros 45 minutos y servimos',
            'raciones' => 2,
            'tiempo_preparacion' => '105',
            'user_id' => 1,
            'categoria_id' => 2
        ]);
        $receta3->addMedia(public_path('imagesSeeder/pollo.jpeg'))->preservingOriginal()->toMediaCollection('photo');

        $receta4 = recetas::create([
            'nombre' => 'Torrijas',
            'descripcion_corta' => 'Dulces y suaves torrijas, un postre tradicional que deleitará tu paladar.',
            'descripcion' => 'Hervimos la leche con la canela y la corteza de limón
            La dejamos enfriar por completo en una fuente
            Retiramos la canela y la piel de limón
            Remojamos el pan en la leche unos minutos
            Dejamos escurrir el pan
            Rebozamos el pan remojado en huevo batido
            Lo freímos
            Retiramos el exceso de aceite con papel absorbente
            Rebozamos las torrijas con azúcar y canela
            Servimos',
            'raciones' => 20,
            'tiempo_preparacion' => '35',
            'user_id' => 1,
            'categoria_id' => 3
        ]);
        $receta4->addMedia(public_path('imagesSeeder/torrijas.jpeg'))->preservingOriginal()->toMediaCollection('photo');

    }
}
