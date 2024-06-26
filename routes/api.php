<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ComentariosController;
use App\Http\Controllers\Api\RecetasController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Api\FavoritosController;
use App\Http\Controllers\Api\CategoriasController;
use App\Http\Controllers\api\PlanSemanalController;
use App\Http\Controllers\api\IngredientesController;
use App\Http\Controllers\api\listaCompraController;
use App\Http\Controllers\api\IngredientesRecetasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Models\planSemanal;

Route::post('forget-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('forget.password.post');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.reset');



// Rutas para los comentarios
Route::get('comentarios', [ComentariosController::class, 'index']);
Route::post('comentarios/', [ComentariosController::class, 'store']);
Route::delete('comentarios/{id}', [ComentariosController::class, 'destroy']);
Route::get('comentarios/{id}', [ComentariosController::class, 'show']);
Route::get('comentario/{id}', [ComentariosController::class, 'find']);
Route::put('comentario/update/{id}', [ComentariosController::class, 'update']);
Route::get('comentario/admin/{id}', [ComentariosController::class, 'showCA']);

// Rutas para las recetas
Route::get('recetas', [RecetasController::class, 'index']);
Route::get('ultimasRecetas', [RecetasController::class, 'ultimasRecetas']);
Route::post('recetas/', [RecetasController::class, 'store']);
Route::post('recetas/update/{id}', [RecetasController::class, 'update']);
Route::delete('recetas/{id}', [RecetasController::class, 'destroy']);
Route::get('recetas/{id}' , [RecetasController::class, 'show']);
Route::get('recetas/RU/{user_id}' , [RecetasController::class, 'showRU']);

// Rutas para los ingredientes
Route::get('ingredientes', [IngredientesController::class, 'index']);
Route::post('ingredientes/', [IngredientesController::class, 'store']);
Route::put('ingredientes/update/{id}', [IngredientesController::class, 'update']);
Route::delete('ingredientes/{id}', [IngredientesController::class, 'destroy']);
Route::post('ingredientes/receta/', [IngredientesRecetasController::class, 'storeInReceta']);
Route::get('ingredientes/receta/{id}', [IngredientesRecetasController::class, 'show']);
Route::put('ingredientes/receta/update/{id}', [IngredientesRecetasController::class, 'updateIngReceta']);
Route::delete('ingredientes/receta/delete/{id}', [IngredientesRecetasController::class, 'deleteIngreReceta']);

//Rutas para Plan Semanal
Route::get('planSemanal/{id}', [PlanSemanalController::class, 'index']);
Route::post('planSemanal/', [PlanSemanalController::class, 'store']);
Route::delete('planSemanal/{id}', [PlanSemanalController::class, 'destroy']);

// Rutas para las recetas Favoritas
Route::get('favoritos/{id}', [FavoritosController::class, 'index']);
Route::post('favoritos/', [FavoritosController::class, 'store']);
Route::delete('favoritos/{id}', [FavoritosController::class, 'destroy']);

//rutas para la lista de la compra
Route::get('/listaCompra/{userId}/{formato}', [listaCompraController::class, 'listaCompra']);


// Rutas para las categorias
Route::get('categorias', [CategoriasController::class, 'index']);

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::apiResource('users', UserController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('roles', RoleController::class);

    Route::get('role-list', [RoleController::class, 'getList']);
    Route::get('role-permissions/{id}', [PermissionController::class, 'getRolePermissions']);
    Route::put('/role-permissions', [PermissionController::class, 'updateRolePermissions']);
    Route::get('/user/roles', [UserController::class, 'usuarioRoles']);
    Route::apiResource('permissions', PermissionController::class);
    Route::get('category-list', [CategoryController::class, 'getList']);
    Route::get('/user', [ProfileController::class, 'user']);
    Route::put('/user', [ProfileController::class, 'update']);

    Route::get('abilities', function(Request $request) {
        return $request->user()->roles()->with('permissions')
            ->get()
            ->pluck('permissions')
            ->flatten()
            ->pluck('name')
            ->unique()
            ->values()
            ->toArray();
    });
});


Route::get('category-list', [CategoryController::class, 'getList']);
