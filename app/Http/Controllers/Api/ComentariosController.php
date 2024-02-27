<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\comentarios;

class ComentariosController extends Controller
{
    public function index(){
        $comentarios = comentarios::all()->toArray();
        return $comentarios;
    }
}
