<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanchaImage extends Model
{
    use HasFactory;

    protected $table = 'imagenes';

    protected $fillable = [
        'cancha_id',
        'ruta',
        'es_principal',
    ];

    /**
     * Relación: una imagen pertenece a una cancha
     */
    public function cancha()
    {
        return $this->belongsTo(Cancha::class);
    }
}
