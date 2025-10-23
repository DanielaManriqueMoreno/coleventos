<?php

namespace App\Http\Controllers\Comprador;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\Request;

class EventoCompradorController extends Controller
{
    // Listado de eventos
    public function index()
    {
        $eventos = Evento::orderBy('fecha_hora_inicio', 'asc')->get();
        return view('comprador.eventos.index', compact('eventos'));
    }

    // Ver información del evento
    public function show($id)
    {
        $evento = Evento::findOrFail($id);
        return view('comprador.eventos.show', compact('evento'));
    }

    // Vista del formulario de compra
    public function comprar($id)
    {
        $evento = Evento::findOrFail($id);
        return view('comprador.eventos.comprar', compact('evento'));
    }

    // Procesar la compra
    public function procesarCompra(Request $request, $id)
    {
        // Aquí luego agregamos la lógica para guardar la compra
        return redirect()->route('comprador.eventos.index')->with('success', 'Compra realizada con éxito.');
    }
}
