<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoPublicController extends Controller
{
    // Listado de eventos
    public function index(Request $request)
{
    $query = Evento::query()->with('artistas', 'boleterias.localidad')
                    ->where('fecha_hora_fin', '>=', now())
                    ->orderBy('fecha_hora_inicio', 'asc');

    if ($request->filled('municipio')) {
        $query->where('municipio', 'like', '%' . $request->municipio . '%');
    }

    $eventos = $query->get();

    return view('comprador.eventos.index', compact('eventos'));
}

public function show(string $id)
{
    $evento = Evento::with('artistas', 'boleterias.localidad')->findOrFail($id);
    return view('comprador.eventos.show', compact('evento'));
}
}