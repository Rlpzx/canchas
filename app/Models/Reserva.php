<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas'; // nombre de la tabla
    protected $primaryKey = 'id_reserva'; // o el nombre de tu PK si es diferente

    protected $fillable = [
        'id_cancha',
        'id_usuario',
        'fecha',
        'hora_inicio',
        'hora_fin',
         'precio',
        'estado', // opcional: puede ser 'pendiente', 'confirmada', 'cancelada', etc.
    ];

    public $timestamps = true;

    /**
     * Relación con la cancha (una reserva pertenece a una cancha)
     */
    public function cancha()
    {
        return $this->belongsTo(Cancha::class, 'id_cancha');
    }

    /**
     * Relación con el usuario (una reserva la hace un usuario)
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
     public function getFechaFormateadaAttribute()
    {
        return \Carbon\Carbon::parse($this->fecha)->format('d/m/Y');
    }

    /**
     * Scopes útiles para búsquedas
     */
    public function scopeHoy($query)
    {
        return $query->whereDate('fecha', now()->toDateString());
    }

    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }
}
