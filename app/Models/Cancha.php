<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cancha extends Model
{
      protected $table = 'canchas';
    protected $primaryKey = 'id_cancha';
    public $incrementing = true;
    protected $keyType = 'int';
     protected $fillable = [
        'nombre',
        'ubicacion',
        'descripcion',
        'precio',
        'tipo',
        'capacidad',
        'horario_apertura',
        'horario_cierre',
        'servicios',
        'imagen_principal',
        'id_admin',
    ];

    // =====================
    // 🔗 RELACIONES
    // =====================

    // Una cancha tiene muchas imágenes
    public function images()
    {
        return $this->hasMany(CanchaImage::class, 'cancha_id', 'id_cancha');
    }

    // Una cancha tiene muchas reservas
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_cancha', 'id_cancha');
    }

    // =====================
    // 🔧 FUNCIONALIDAD EXTRA
    // =====================

  

    public function firstImage()
    {
        return $this->images()->first();
    }

    public function getImagenUrlAttribute()
    {
        return asset('storage/' . $this->imagen_principal);
    }
    public function administrador()
{
    return $this->belongsTo(\App\Models\Administrador::class, 'id_admin', 'id');
}

}
