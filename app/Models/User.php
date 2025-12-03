<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios'; // 👈 importante
    protected $primaryKey = 'id'; // o el nombre de tu PK

    protected $fillable = [
        'nombre',
        'correo',
        'contrasena',
        'id_rol'
    ];

    protected $hidden = [
        'contrasena',
    ];

    public $timestamps = true;

    public function getAuthPassword()
    {
        return $this->contrasena; // 👈 Laravel usará este campo para autenticar
    }


    public function rol()
{
    return $this->belongsTo(Rol::class, 'id_rol', 'id');
}

public function esAdmin()
{
    return $this->rol && $this->rol->nombre === 'administrador';
}
public function reservas()
{
    // si la FK en reservas es cliente_id:
    return $this->hasMany(\App\Models\Reserva::class, 'id_usuario');
}



}
