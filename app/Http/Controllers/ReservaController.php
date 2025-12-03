<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Cancha;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ReservaController extends Controller
{
   

    // listar reservas del usuario (o todas si admin)
    public function index()
    {
        $user = Auth::user();
        if ($user->is_admin ?? false) {
            $reservas = Reserva::with('cancha','user')->orderBy('fecha','desc')->paginate(12);
        } else {
            $reservas = $user->reservas()->with('cancha')->orderBy('fecha','desc')->paginate(12);
        }
        return view('reservas.index', compact('reservas'));
    }

    // formulario para crear reserva
    public function create()
    {
        $canchas = Cancha::all();
        return view('reservas.create', compact('canchas'));
    }

    // almacenar reserva con verificación de solapamiento
public function store(Request $request)
{
    $data = $request->validate([
        'id_cancha' => ['required', 'integer', Rule::exists('canchas','id_cancha')],
        'fecha' => 'required|date|after_or_equal:today',
        'hora_inicio' => 'required|date_format:H:i',
        'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
    ], [
        'id_cancha.required' => 'Debes seleccionar una cancha.',
    ]);

    $canchaId = $data['id_cancha'];
    $fecha = $data['fecha'];
    $inicio = $data['hora_inicio'];
    $fin = $data['hora_fin'];

    // Verificar solapamiento
    $conflicto = Reserva::where('id_cancha', $canchaId)
        ->whereDate('fecha', $fecha)
        ->where(function($q) use ($inicio, $fin) {
            $q->where('hora_inicio', '<', $fin)
              ->where('hora_fin', '>', $inicio);
        })->exists();

    if ($conflicto) {
        return back()
            ->withInput()
            ->withErrors(['hora_inicio' => 'La cancha ya está reservada en ese horario.']);
    }

    $cancha = Cancha::where('id_cancha', $canchaId)->first();
    $precio = null;
    if ($cancha && $cancha->precio) {
        $horaInicio = \Carbon\Carbon::createFromFormat('H:i', $inicio);
        $horaFin = \Carbon\Carbon::createFromFormat('H:i', $fin);
        $duracionHoras = $horaInicio->diffInMinutes($horaFin) / 60;
        $precio = $cancha->precio * $duracionHoras;
    }

    Reserva::create([
        'id_usuario' => Auth::id(),
        'id_cancha' => $canchaId,
        'fecha' => $fecha,
        'hora_inicio' => $inicio,
        'hora_fin' => $fin,
        'precio' => $precio,
        'estado' => 'pendiente',
    ]);

    return redirect()->route('reservas.index')->with('success', 'Reserva creada correctamente.');
}


    public function show($id)
    {
        $reserva = Reserva::with('cancha','usuario')->findOrFail($id);
        // verifica permisos: solo propietario o admin
        
        return view('reservas.show', compact('reserva'));
    }

    public function destroy($id)
    {
        $reserva = Reserva::findOrFail($id);
      
        $reserva->delete();
        return redirect()->route('reservas.index')->with('success','Reserva cancelada.');
    }
}
