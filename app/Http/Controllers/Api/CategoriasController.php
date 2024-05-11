<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\categorias;

class CategoriasController extends Controller
{
    // Extrae todas las categorias
    public function index(){

        $categorias = categorias::all()->toArray();
        return $categorias;
    }
}
