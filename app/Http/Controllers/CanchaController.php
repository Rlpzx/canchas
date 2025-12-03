<?php

namespace App\Http\Controllers;

use App\Models\Cancha;
use App\Models\CanchaImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class CanchaController extends Controller
{
    // listado básico (paginado)
    public function index(Request $request)
    {
        $query = Cancha::with('images');
       


        // filtros simples (ubicacion, tipo, precio)
        if ($request->filled('ubicacion')) {
            $query->where('ubicacion','like','%'.$request->ubicacion.'%');
        }
        if ($request->filled('tipo')) {
            $query->where('tipo',$request->tipo);
        }
        if ($request->filled('precio')) {
            [$min,$max] = explode('-', $request->precio);
            $query->whereBetween('precio', [(float)$min, (float)$max]);
        }


          if ($request->filled('orden')) {
            if ($request->orden === 'precio_asc') {
                $query->orderBy('precio', 'asc');
            } elseif ($request->orden === 'precio_desc') {
                $query->orderBy('precio', 'desc');
            } elseif ($request->orden === 'nuevo') {
                $query->latest();
            }
        }
      
       $canchas = $query->paginate(9);
       $canchas = Cancha::with('administrador')->paginate(9);
      $canchas = Cancha::with(['administrador.usuario'])->paginate(10);



         

         return view('canchas', compact('canchas'));
}
// Mostrar listado para administrador
public function indexAdmin()
{
    $canchas = Cancha::with('images')->where('id_admin', auth()->id())->paginate(10);
    return view('admin.canchaAdmi', compact('canchas'));
}

    

    // formulario
    public function create()
    {
        return view('crear_cancha');
    }

    // almacenar cancha + multiples imágenes
public function store(Request $request)
    {
        // Validar los campos
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'tipo' => 'nullable|string',
            'capacidad' => 'nullable|integer',
            'horario_apertura' => 'nullable',
            'horario_cierre' => 'nullable',
            'servicios' => 'nullable|string',
            'imagen_principal' => 'nullable|image|max:2048',
            'imagenes.*' => 'nullable|image|max:2048',
        ]);

        // Asignar el administrador que crea la cancha
        $data['id_admin'] = auth()->id();

        // Guardar imagen principal
        if ($request->hasFile('imagen_principal')) {
            $data['imagen_principal'] = $request->file('imagen_principal')->store('canchas', 'public');
        }

        // Crear la cancha
        $cancha = Cancha::create($data);

        // Guardar imágenes adicionales
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $ruta = $imagen->store('canchas', 'public');
                $cancha->images()->create([
                'ruta' => $ruta,
               'es_principal' => false,
                ]);

            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Cancha registrada correctamente.');
    }



    public function edit($id)
{
    $cancha = Cancha::findOrFail($id);
    return view('admin.edit', compact('cancha'));
}

public function update(Request $request, $id)
{
    $cancha = Cancha::findOrFail($id);

    $data = $request->validate([
        'nombre' => 'required|string|max:255',
        'ubicacion' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'precio' => 'required|numeric',
        'tipo' => 'nullable|string|max:255',
        'capacidad' => 'nullable|integer',
        'horario_apertura' => 'nullable',
        'horario_cierre' => 'nullable',
        'servicios' => 'nullable|string',
    ]);

    $cancha->update($data);

    return redirect()->route('canchaA')->with('success', 'Cancha actualizada correctamente.');
}


public function destroy($id)
{
    $cancha = Cancha::findOrFail($id);

    // Si la cancha tiene imagen, la eliminamos del almacenamiento
    if ($cancha->imagen && \Storage::exists('public/' . $cancha->imagen)) {
        \Storage::delete('public/' . $cancha->imagen);
    }

    $cancha->delete();

    return redirect()->route('canchaA')->with('success', 'Cancha eliminada correctamente');
}


    // detalle
  public function show(Cancha $cancha)
{
    // Aumenta el contador de búsquedas cada vez que alguien entra al detalle
    $cancha->increment('busquedas');

    // Carga las imágenes relacionadas (si tienes la relación definida)
    $cancha->load('images');

    // Devuelve la vista del detalle de la cancha
    return view('canchas.show', compact('cancha'));
}
public function administrador()
{
    return $this->belongsTo(Administrador::class, 'id_admin', 'id');
}


}
