<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cancha;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // cancha destacada (la más vista)
     $featured = Cancha::with('images')->orderBy('busquedas','desc')->first();

      $canchaMasBarata = Cancha::with('images') ->orderBy('precio', 'asc') ->first();


        // 2 tarjetas de sidebar: la más reservada y la más nueva
        // Ajusta columnas (por ejemplo 'reservas' o 'visitas') si existen
       $mostReserved = Cancha::withCount('reservas')
    ->orderBy('reservas_count', 'desc')
    ->first();

        $latest = Cancha::orderBy('created_at', 'desc')->first();


        // También podrías traer "top 6" para mostrar en otras secciones
        $latestList = Cancha::orderBy('created_at','desc')->paginate(6);

        return view('index', compact('featured',  'mostReserved', 'latest', 'latestList', 'canchaMasBarata'));
    }
}
