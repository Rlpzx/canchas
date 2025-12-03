<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminReservaController extends Controller
{
    /**
     * Mostrar solo las reservas de las canchas que pertenecen al admin autenticado
     */
    public function index()
    {
        $adminId = $this->getAdminId();

        $reservas = Reserva::whereHas('cancha', function ($q) use ($adminId) {
                $q->where('id_admin', $adminId);
            })
            ->with(['usuario', 'cancha'])
            ->orderBy('fecha', 'desc')
            ->paginate(10);

        return view('admin.reservas.index', compact('reservas'));
    }

    public function show($id)
    {
        $adminId = $this->getAdminId();

        $reserva = Reserva::with(['usuario', 'cancha'])->findOrFail($id);

        if (! $this->reservaPerteneceAlAdmin($reserva, $adminId)) {
            abort(403, 'No tienes permiso para ver esta reserva.');
        }

        return view('admin.reservas.show', compact('reserva'));
    }

    public function update(Request $request, $id)
    {
        $adminId = $this->getAdminId();

        $reserva = Reserva::with('cancha')->findOrFail($id);

        if (! $this->reservaPerteneceAlAdmin($reserva, $adminId)) {
            abort(403, 'No tienes permiso para actualizar esta reserva.');
        }

        $reserva->update([
            'estado' => $request->input('estado'),
        ]);

        return redirect()->route('admin.reservas')->with('success', 'Estado actualizado correctamente');
    }

    public function destroy($id)
    {
        $adminId = $this->getAdminId();

        $reserva = Reserva::with('cancha')->findOrFail($id);

        if (! $this->reservaPerteneceAlAdmin($reserva, $adminId)) {
            abort(403, 'No tienes permiso para eliminar esta reserva.');
        }

        $reserva->delete();

        return redirect()->route('admin.reservas')->with('success', 'Reserva eliminada correctamente');
    }

    protected function getAdminId()
    {
        $user = Auth::user();
        // Ajusta si tu modelo de admin usa id_admin en lugar de id
        return $user->id ?? $user->id_admin ?? Auth::id();
    }

    protected function reservaPerteneceAlAdmin(Reserva $reserva, $adminId)
    {
        if (! $reserva->relationLoaded('cancha')) {
            $reserva->load('cancha');
        }

        if (! $reserva->cancha) {
            return false;
        }

        return ($reserva->cancha->id_admin ?? null) == $adminId;
    }
}
