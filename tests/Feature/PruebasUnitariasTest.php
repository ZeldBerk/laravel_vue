<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class PruebasUnitariasTest extends TestCase
{

    // Prueba unitaria para añadir un ingrediente correctamente
    public function test_new_ingredient_ok()
    {
        $datos = [
            'nombre' => 'Prueba Unitaria',
        ];

        // Realizar la solicitud POST a la ruta de la API para añadir un ingrediente
        $response = $this->postJson('/api/ingredientes', $datos);

        // Verificar que la solicitud tenga éxito (código de estado 200)
        $response->assertStatus(200);

        // Verificar que el ingrediente se haya añadido correctamente a la base de datos
        $this->assertDatabaseHas('ingredientes', $datos);
    }


    // Prueba unitaria para añadir un ingrediente incorrectamente
    public function test_new_ingredient_ko()
    {
        $datos = [
            'nombre' => null,
        ];

        // Realizar la solicitud POST a la ruta de la API para añadir un ingrediente
        $response = $this->postJson('/api/ingredientes', $datos);

        // Verificar que la solicitud falle debido a datos incorrectos (código de estado 422)
        $response->assertStatus(422);

        // Obtener el mensaje de error devuelto por la API
        $mensajeError = $response->json();

        // Comparar el mensaje de error devuelto con el mensaje esperado
        $this->assertSame('The nombre field is required.', $mensajeError['message']);
    }



    // Prueba unitaria para agregar un comentario correctamente
    public function test_new_comment_ok()
    {

        $datos = [
            'user_id' => 1,
            'receta_id' => 1,
            'contenido' => 'Este es un comentario válido',
            'puntuacion' => 5
        ];

        // Realizar una solicitud POST a la ruta de la API para agregar un comentario
        $response = $this->postJson('/api/comentarios', $datos);

        // Verificar que la solicitud tenga éxito (código de estado 200)
        $response->assertStatus(200);

        // Verificar que el comentario se haya agregado correctamente a la base de datos
        $this->assertDatabaseHas('comentarios', $datos);
    }


    // Prueba unitaria para intentar agregar un comentario con datos faltantes
    public function test_new_comment_ko()
    {

        $datos = [
            'receta_id' => 1,
            'contenido' => null,
            'puntuacion' => 4
        ];

        // Realizar una solicitud POST a la ruta de la API para agregar un comentario
        $response = $this->postJson('/api/comentarios', $datos);

        // Verificar que la solicitud falle debido a datos faltantes (código de estado 422)
        $response->assertStatus(422);

        // Obtener el mensaje de error devuelto por la API
        $mensajeError = $response->json();

        // Comparar el mensaje de error devuelto con el mensaje esperado
        $this->assertSame('The user id field is required. (and 1 more error)', $mensajeError['message']);
    }



    // Prueba para añadir una receta correctamente
    public function test_new_recipe_ok()
    {
        // Datos de la receta
        $datos = [
            'nombre' => 'Nueva receta',
            'descripcion_corta' => 'Descripción corta de la receta',
            'descripcion' => 'Descripción detallada de la receta',
            'raciones' => 4,
            'tiempo_preparacion' => '60',
            'user_id' => 1,
            'categoria_id' => 1
        ];

        // Simular la carga de un archivo de imagen ficticio
        $imagenFicticia = '/ruta/a/imagen-ficticia.jpg';

        // Realizar la solicitud POST a la ruta de la API para añadir una receta
        $response = $this->postJson('/api/recetas', array_merge($datos, ['thumbnail' => $imagenFicticia]));

        // Verificar que la solicitud tenga éxito (código de estado 200)
        $response->assertStatus(200);

        // Verificar que la receta se haya añadido correctamente a la base de datos
        $this->assertDatabaseHas('recetas', $datos);
    }


    // Prueba unitaria para añadir una receta incorrectamente debido a datos faltantes
    public function test_new_recipe_ko()
    {
        // Datos de la receta con campos obligatorios faltantes
        $datos = [
            'nombre' => 'Nueva receta KO',
            'descripcion_corta' => null,
            'descripcion' => null,
            'raciones' => null,
            'tiempo_preparacion' => null,
            'user_id' => null,
            'categoria_id' => null,
        ];

        // Realizar la solicitud POST a la ruta de la API para añadir una receta con datos incompletos
        $response = $this->postJson('/api/recetas', $datos);

        // Verificar que la solicitud falle debido a datos incompletos (código de estado 422)
        $response->assertStatus(422);

        // Obtener el mensaje de error devuelto por la API
        $mensajeError = $response->json();

        // Comparar el mensaje de error devuelto con el mensaje esperado
        $this->assertSame('The descripcion corta field is required. (and 5 more errors)', $mensajeError['message']);
    }
}
