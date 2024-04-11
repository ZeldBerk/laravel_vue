<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingredientes_recetas extends Model
{
    use HasFactory;

    protected $fillable = ['receta_id','ingrediente_id'];
}
