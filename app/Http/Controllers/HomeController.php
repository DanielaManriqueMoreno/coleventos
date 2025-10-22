<?php

namespace App\Http\Controllers;

use App\Models\Evento;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener todos los eventos (sin filtro por fecha para probar)
        $eventos = Evento::orderBy('fecha_hora_inicio', 'asc')->get();
        
        return view('welcome', compact('eventos'));
    }
}