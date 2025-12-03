<?php

namespace App\Http\Controllers;

use App\Models\Cancha;
use Illuminate\Http\Request;

class CanchaPublicController extends Controller
{
    public function show($id)
    {
        $cancha = Cancha::with(['images', 'administrador.usuario'])->findOrFail($id);
        return view('detalle', compact('cancha'));
    }
}
