<?php

namespace App\Http\Controllers; 

use App\Models\Artista;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException; 

class EventoArtistaController extends Controller
{
    
    public function create(string $evento_id) // Recibe el ID del evento desde la ruta
    {
        $evento = Evento::find($evento_id);
        if (!$evento) {
            session()->flash('warning', 'Evento no encontrado.');
            return redirect()->route('admin.evento.index');
        }

        $artistas = Artista::orderBy('nombres')->get();

        return view('admin.evento_artista.create', compact('evento', 'artistas'));
    }

    public function store(Request $request, string $evento_id)
    {
        $evento = Evento::findOrFail($evento_id);

        // 1. Validar que se seleccionó un artista
        $validator = Validator::make($request->all(), [
            'artista_id' => 'required|exists:artista,id'
        ], [
            'artista_id.required' => 'Debes seleccionar un artista.',
            'artista_id.exists' => 'El artista seleccionado no es válido.'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.evento.artista.create', $evento_id)
                             ->withInput()->withErrors($validator);
        }

        $artistaId = $request->input('artista_id');
        $artista = Artista::find($artistaId);

        $nuevoEventoInicio = $evento->fecha_hora_inicio;
        $nuevoEventoFin = $evento->fecha_hora_fin;

        
        $conflicto = $artista->eventos()

            ->where('evento.id', '!=', $evento->id) 
            ->where(function ($query) use ($nuevoEventoInicio, $nuevoEventoFin) {
                // El evento existente termina DESPUÉS de que empieza el nuevo
                $query->where('fecha_hora_fin', '>', $nuevoEventoInicio)
                // Y el evento existente empieza ANTES de que termine el nuevo
                      ->where('fecha_hora_inicio', '<', $nuevoEventoFin);
            })
            ->exists(); // Devuelve true si encuentra algún cruce

        if ($conflicto) {

            throw ValidationException::withMessages([
                'horario' => 'Conflicto de horario: El artista ya está asignado a otro evento en ese rango de fechas/horas.'
            ]);
        }
     
        $evento->artistas()->syncWithoutDetaching($artistaId);

        session()->flash('message', 'Artista "' . $artista->nombres . '" asociado al evento "' . $evento->nombre . '" exitosamente.');
        
        // Redirigir de vuelta al index de eventos o al detalle del evento
        return redirect()->route('admin.evento.index'); 
    }

    public function destroy(string $evento_id, string $artista_id)
    {
        $evento = Evento::findOrFail($evento_id);
        $artista = Artista::findOrFail($artista_id);

        // detach quita la relación de la tabla pivote
        $evento->artistas()->detach($artista_id);

        session()->flash('message', 'Artista "' . $artista->nombres . '" desasociado del evento "' . $evento->nombre . '".');
        return redirect()->back(); 
    }
}