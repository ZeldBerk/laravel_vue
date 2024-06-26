<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class recetas extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'nombre',
        'descripcion_corta',
        'descripcion',
        'raciones',
        'tiempo_preparacion',
        'user_id',
        'categoria_id'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('iamges/recetas')
            ->useFallbackUrl('/iamges/placeholder.jpg')
            ->useFallbackPath(public_path('/images/placeholder.jpg'));
    }

    public function registerMediaConversions(Media $media = null): void
    {
        if (env('RESIZE_IMAGE') === true) {
            $this->addMediaConversion('resized-image')
                ->width(env('IMAGE_WIDTH', 300))
                ->height(env('IMAGE_HEIGHT', 300));
        }
    }

    public function favoritos()
    {
        return $this->belongsToMany(User::class, 'favoritos', 'receta_id', 'user_id')->withTimestamps();
    }

    public function planSemanal()
    {
        return $this->belongsToMany(User::class, 'plan_semanals', 'receta_id', 'user_id')->withTimestamps();
    }

    public function ingredientes()
    {
        return $this->belongsToMany(ingrediente::class, 'ingredientes_recetas', 'receta_id', 'ingrediente_id')
            ->withPivot('cantidad', 'unidad');
    }
}
