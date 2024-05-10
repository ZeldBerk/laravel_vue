<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingrediente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre'
    ];

    public function recetas()
    {
        return $this->belongsToMany(recetas::class, 'ingredientes_recetas', 'ingrediente_id', 'receta_id')
            ->withPivot('cantidad', 'unidad');
    }
}
