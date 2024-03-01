<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recetas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'ruta_imagen',
        'raciones',
        'tiempo_preparacion',
        'user_id',
        'categoria_id'
    ];
}
