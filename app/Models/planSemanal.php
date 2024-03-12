<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class planSemanal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'receta_id',
        'dia_semana'
    ];

    public function receta(){
        return $this->belongsTo(recetas::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
