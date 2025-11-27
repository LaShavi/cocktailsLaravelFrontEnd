<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cocktail extends Model
{
    /**
     * Campos que se pueden asignar masivamente
     */
    protected $fillable = [
        'api_id',
        'name',
        'category',
        'glass',
        'instructions',
        'image_url',
        'ingredients',
        'user_id',
    ];

    /**
     * Atributos que deben ser casteados
     */
    protected $casts = [
        'ingredients' => 'json',
    ];

    /**
     * Relación: Un cóctel pertenece a un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
