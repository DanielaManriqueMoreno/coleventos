<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoPublicController extends Controller
{
    // Listado de eventos
    public function index(Request $request)
    {
        $query = Evento::with('localidades'); // Traemos localidades para cada evento

        if ($request->filled('q')) {
            $query->where('nombre', 'like', '%' . $request->q . '%')
                  ->orWhere('municipio', 'like', '%' . $request->q . '%')
                  ->orWhere('departamento', 'like', '%' . $request->q . '%');
        }
        $eventos = $query->latest()->paginate(6);

        return view('comprador.index', compact('eventos'));
    }

    // Mostrar detalles de un evento
    public function show($id)
    {
        $evento = Evento::with('localidades')->findOrFail($id);
        return view('comprador.show', compact('evento'));
    }
}
