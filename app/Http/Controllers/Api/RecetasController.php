<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\recetas;
use Spatie\Permission\Traits\HasRoles;
use App\Models\User;

class RecetasController extends Controller
{
    use HasRoles;

    //Obtener todas las recetas y filtrarlas 
    public function index(Request $request)
    {
        $filtro = $request->input('filtro');
        $id_categoria = $request->input('categoria');

        $query = recetas::with('media');

        // Aplicar filtro si se proporciona
        if ($filtro) {
            $query->where('nombre', 'like', '%' . $filtro . '%');
        }

        // Aplicar filtro por categoría si se proporciona
        if ($id_categoria) {
            $query->where('categoria_id', $id_categoria);
        }

        $recetas = $query->get();

        return $recetas;
    }


    //Ultimas recetas añadidas para la home
    public function ultimasRecetas()
    {
        $recetas = recetas::with('media')->orderBy('created_at', 'desc')->take(4)->get();

        return $recetas;
    }


    // Añade una receta a la BBDD
    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required',
            'descripcion_corta' => 'required',
            'descripcion' => 'required',
            'raciones' => 'required',
            'tiempo_preparacion' => 'required',
            'user_id' => 'required',
            'categoria_id' => 'required'
        ]);

        $contReceta = $request->all();
        $receta = recetas::create($contReceta);

        if ($request->hasFile('thumbnail')) {
            $receta->addMediaFromRequest('thumbnail')->preservingOriginal()->toMediaCollection('images-recetas');
        }

        return response()->json(['success' => true, 'data' => $receta, 'id' => $receta->id]);
    }


    // Actualiza una receta
    public function update($id, Request $request)
    {

        $receta = recetas::find($id);

        $request->validate([
            'nombre' => 'required',
            'descripcion_corta' => 'required',
            'descripcion' => 'required',
            'raciones' => 'required',
            'tiempo_preparacion' => 'required',
            'user_id' => 'required',
            'categoria_id' => 'required'
        ]);

        $contToUpdate = $request->all();
        $receta->update($contToUpdate);

        if ($request->hasFile('thumbnail')) {
            $receta->media()->delete();
            $receta->addMediaFromRequest('thumbnail')->preservingOriginal()->toMediaCollection('images-recetas');
        }

        return response()->json(['success' => true, 'data' => $receta]);
    }


    // Elimina la receta mediante id
    public function destroy($id)
    {

        $receta = recetas::find($id);

        $receta->delete();

        return response()->json(['success' => true, 'data' => 'Receta eliminada correctamanete']);
    }



    // Devuelve una receta mediante id
    public function show($id)
    {

        $receta = recetas::with('media')->find($id);

        return $receta;
    }


    // Devuelve las recetas asociadas a un id de usuario
    public function showRU(Request $request, $user_id)
    {
        $filtro = $request->input('filtro');

        $user = User::findOrFail($user_id);
        $roles = $user->roles;

        // Verificar si el usuario tiene el rol de administrador y si se deben mostrar todas las recetas
        if ($roles->contains('name', 'admin')) {

            $query = recetas::with('media');
        } else {

            $query = recetas::where('user_id', $user_id)->with('media');
        }

        // Aplicar filtro si se proporciona
        if ($filtro) {
            $query->where('nombre', 'like', '%' . $filtro . '%');
        }

        $recetas = $query->get();

        return $recetas;
    }
}
