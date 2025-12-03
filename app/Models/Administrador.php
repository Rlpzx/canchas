<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Administrador extends Model
{
    use HasFactory;

    protected $table = 'administradores';

    protected $fillable = [
        'id_usuario',
        'nombre_local',
        'direccion',
        'telefono',
    ];

   public function usuario()
{
    return $this->belongsTo(User::class, 'id_usuario', 'id');
}
public function canchas()
{
    return $this->hasMany(\App\Models\Cancha::class, 'id_admin', 'id');
}


}
