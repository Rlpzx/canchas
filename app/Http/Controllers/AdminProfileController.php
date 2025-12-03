<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Administrador;
use App\Models\Reserva;


class AdminProfileController extends Controller
{
      public function index()
    {
        $admin = Administrador::where('id_usuario', Auth::id())->first();
        return view('admin.dashboard', compact('admin'));
    }
    public function show()
    {
        $user = Auth::user();
        $admin = Administrador::where('id_usuario', $user->id)->first();

        return view('admin.profile', compact('user', 'admin'));
    }

    public function edit()
    {
        $user = Auth::user();
        $admin = Administrador::where('id_usuario', $user->id)->first();

        return view('admin.edit_profile', compact('user', 'admin'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $admin = Administrador::where('id_usuario', $user->id)->firstOrFail();

        $data = $request->validate([
            'nombre_local' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        $admin->update($data);

        return redirect()->route('admin.profile')->with('success', 'Perfil actualizado correctamente.');
    }
    public function indexR()
    {
        // Traer todas las reservas con relaciones
        $reservas = Reserva::with(['usuario', 'cancha'])->orderBy('fecha', 'desc')->paginate(10);

        return view('admin.reservas.index', compact('reservas'));
    }

    public function destroy($id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->delete();

        return redirect()->route('admin.reservas')->with('success', 'Reserva eliminada correctamente.');
    }

}
