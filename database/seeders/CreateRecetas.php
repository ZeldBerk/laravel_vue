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
            'descripcion' => 'Ponemos en una sartén honda la mantequilla fundida y la harina para preparar la bechamel.
            Cocinamos la harina con la mantequilla y añadimos poco a poco la leche caliente.
            Salpimentamos la bechamel y le añadimos nuez moscada recién rallada.
            Añadimos el jamón serrano en tacos pequeños.
            Vertemos la masa de las croquetas sobre un molde cuadrado y lo llevamos a la nevera.
            Cortamos la masa en pociones.
            Formamos las croquetas y las pasamos por huevo y pan rallado.
            Llevamos las croquetas a enfriar a la nevera y después las freímos en tandas pequeñas.
            Servimos las croquetas calientes.',
            'raciones' => 6,
            'tiempo_preparacion' => '360',
            'user_id' => 1,
            'categoria_id' => 1
        ]);
        $receta1->addMedia(public_path('imagesSeeder/Croquetas.jpeg'))->preservingOriginal()->toMediaCollection('photo');
        

        $receta2 = recetas::create([
            'nombre' => 'Tarta de Queso',
            'descripcion_corta' => 'Una tentadora tarta de queso cremosa y llena de sabor, ¡irresistible!',
            'descripcion' => 'Precalentamos el horno a 200 ºC, ponemos en un bol el queso crema y añadimos los huevos de uno en uno.
            Removemos e integramos la mezcla.
            Añadimos el azúcar e integramos.
            Añadimos la harina y de nuevo integramos siempre con unas varillas.
            Finalmente, añadimos la nata e integramos de nuevo.
            Forramos un molde con papel vegetal humedecido.
            Vertemos la mezcla en el molde con el papel.
            Horneamos a 200 ºC durante 40 minutos.
            Retiramos la tarta de queso La Viña del horno, la dejamos atemperar para que adquiera la textura adecuada y la servimos.
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
            'descripcion' => 'Pelamos, lavamos y cortamos en rodajas las patatas.
            Las salpimentamos, las ponemos sobre una bandeja de horno engrasada y añadimos la cebolla y los ajos.
            Salpimentamos las piezas de pollo.
            Ponemos el pollo sobre la cama de patatas, vertemos el vino y añadimos el romero.
            Asamos el pollo con las patatas 45 minutos a 200 ºC y giramos las piezas.
            Devolvemos el pollo al horno para hornearlo otros 45 minutos y servimos.',
            'raciones' => 2,
            'tiempo_preparacion' => '105',
            'user_id' => 1,
            'categoria_id' => 2
        ]);
        $receta3->addMedia(public_path('imagesSeeder/pollo.jpeg'))->preservingOriginal()->toMediaCollection('photo');

        $receta4 = recetas::create([
            'nombre' => 'Torrijas',
            'descripcion_corta' => 'Dulces y suaves torrijas, un postre tradicional que deleitará tu paladar.',
            'descripcion' => 'Hervimos la leche con la canela y la corteza de limón.
            La dejamos enfriar por completo en una fuente.
            Retiramos la canela y la piel de limón.
            Remojamos el pan en la leche unos minutos.
            Dejamos escurrir el pan.
            Rebozamos el pan remojado en huevo batido.
            Lo freímos.
            Retiramos el exceso de aceite con papel absorbente.
            Rebozamos las torrijas con azúcar y canela.
            Servimos.',
            'raciones' => 20,
            'tiempo_preparacion' => '35',
            'user_id' => 1,
            'categoria_id' => 3
        ]);
        $receta4->addMedia(public_path('imagesSeeder/torrijas.jpeg'))->preservingOriginal()->toMediaCollection('photo');


        $receta5 = recetas::create([
            'nombre' => 'Tortilla de Patatas con Cebolla',
            'descripcion_corta' => 'Jugosa tortilla de patatas Española con cebolla',
            'descripcion' => 'Cortamos las patatas a rodajas finas y la cebolla a juliana.
            Ponemos en una sartén el aceite caliente con las patatas, la cebolla y sal.
            Freímos las patatas y la cebolla hasta que queden blandas.
            Colamos las patatas y la cebolla para eliminar el exceso de aceite.
            Batimos los huevos.
            Añadimos a los huevos las patatas y la cebolla.
            Cuajamos la tortilla por un lado según el punto deseado.
            Cuajamos la tortilla por el otro.
            Servimos la tortilla caliente, templada o fría según el gusto.',
            'raciones' => 2,
            'tiempo_preparacion' => '40',
            'user_id' => 1,
            'categoria_id' => 1
        ]);

        $receta5->addMedia(public_path('imagesSeeder/TortillaDePatatas.jpg'))->preservingOriginal()->toMediaCollection('photo');

        $receta6 = recetas::create([
           'nombre' => 'Empanada Gallega',
           'descripcion_corta' => 'Maravillosa Empanada Gallega de Bonito y Pimiento',
           'descripcion' => 'Para el relleno, trocear la cebolla y el pimiento.
           Pocharlos con el aceite y el pimentón.
           Escurrir parte del aceite para la masa.
           Incorporar el atún o bonito al sofrito, mezclar y reservar.
           Para la masa, mezclar los ingredientes de esta y amasar.
           Dejar reposar y precalentar el horno.
           Dividir la masa en dos partes y estirarlas.
           Repartir el relleno en la base.
           Tapar con la otra masa.
           Sellar los bordes.
           Decorar la empanada con la masa reservada y hacer un agujero en el centro.
           Pincelarla con huevo batido.
           Hornearla 40 minutos a 210 ºC.
           Comprobar el punto de cocción.
           Dejar enfriar y servir.',
           'raciones' => 8,
           'tiempo_preparacion' => '90',
           'user_id' => 1,
           'categoria_id' => 1
        ]);

        $receta6->addMedia(public_path('imagesSeeder/empanadaGallega.jpg'))->preservingOriginal()->toMediaCollection('photo');

        $receta7 = recetas::create([
           'nombre' => 'Berenjenas rellenas de carne picada',
           'descripcion_corta' => 'Brutales berenjenas rellenas de carne',
           'descripcion' => 'Lavamos y cortamos las berenjenas, les hacemos unos cortes sin llegar a la piel y las horneamos 30 minutos a 180ºC.
           Cortamos la cebolla y los ajos y rallamos las zanahorias.
           Pochamos las verduras.
           Añadimos la carne picada y rectificamos de sal y pimienta.
           Vaciamos la pulpa de las berenjenas.
           Añadimos la pulpa de las berenjenas a las verduras pochadas.
           Añadimos los tomates rallados y los cocinamos.
           Vertemos un vasito de vino blanco y dejamos que se evapore el alcohol.
           Rellenamos las berenjenas con el relleno de carne.
           Hacemos la bechamel con la mantequilla, la harina y la leche y cubrimos las berenjenas con ella.
           Añadimos queso rallado a la superficie.
           Gratinamos las berenjenas rellenas de carne al horno y servimos.',
           'raciones' => 4,
           'tiempo_preparacion' => '55',
           'user_id' => 1,
           'categoria_id' => 2
        ]);

        $receta7->addMedia(public_path('imagesSeeder/BerenjenaRellena.jpg'))->preservingOriginal()->toMediaCollection('photo');

        $receta8 = recetas::create([
           'nombre' => 'Pasta Carbonara',
           'descripcion_corta' => 'Autentica pasta Carbonara con Yemas de Huevo y Guanciale',
           'descripcion' => 'Salteamos el guanciale.
           Mezclamos las yemas de huevo con el queso.
           Cocemos los espaguetis.
           Agregamos los espaguetis cocidos a la mezcla de huevo y queso.
           Incorporamos el guanciale.
           Espolvoreamos con pimienta negra y servimos.',
           'raciones' => 1,
           'tiempo_preparacion' => '25',
           'user_id' => 1,
           'categoria_id' => 1
        ]);

        $receta8->addMedia(public_path('imagesSeeder/PastaCarbonara.jpg'))->preservingOriginal()->toMediaCollection('photo');

    }
}
