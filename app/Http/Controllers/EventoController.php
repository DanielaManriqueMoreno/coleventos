<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventoController extends Controller
{
    private $rules = [
        'nombre' => 'required|string|max:200',
        'descripcion' => 'required|string',
        'fecha_hora_inicio' => 'required|date',
        'fecha_hora_fin' => 'required|date|after:fecha_hora_inicio',
        'municipio' => 'required|string|max:100',
        'departamento' => 'required|string|max:100',
    ];

    private $traductionAttributes = [
        'nombre' => 'nombre',
        'descripcion' => 'descripción',
        'fecha_hora_inicio' => 'fecha y hora de inicio',
        'fecha_hora_fin' => 'fecha y hora de fin',
        'municipio' => 'municipio',
        'departamento' => 'departamento',
    ];

    public function index()
    {
        $eventos = Evento::all();
        return view('admin.evento.index', compact('eventos'));
    }

    public function create()
    {
        return view('admin.evento.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        $validator->setAttributeNames($this->traductionAttributes);
        if ($validator->fails()) {
            return redirect()->route('evento.create')->withInput()->withErrors($validator);
        }

        Evento::create($request->all());
        session()->flash('message', 'Evento creado exitosamente');
        return redirect()->route('evento.index');
    }

    public function show(string $id)
    {
        // Redirigir a editar, ya que 'show' es más para el público
        return redirect()->route('evento.edit', $id);
    }

    public function edit(string $id)
    {
        $evento = Evento::find($id);
        if ($evento) {
            return view('admin.evento.edit', compact('evento'));
        } else {
            session()->flash('warning', 'No se encuentra el evento solicitado');
            return redirect()->route('evento.index');
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), $this->rules);
        $validator->setAttributeNames($this->traductionAttributes);
        if ($validator->fails()) {
            return redirect()->route('evento.edit', $id)->withInput()->withErrors($validator);
        }

        $evento = Evento::find($id);
        if ($evento) {
            $evento->update($request->all());
            session()->flash('message', 'Evento actualizado exitosamente');
        } else {
            session()->flash('warning', 'No se encuentra el evento solicitado');
        }

        return redirect()->route('evento.index');
    }

    public function destroy(string $id)
    {
        $evento = Evento::find($id);
        if ($evento) {
            $evento->delete();
            session()->flash('message', 'Evento eliminado exitosamente');
        } else {
            session()->flash('warning', 'No se encuentra el evento solicitado');
        }

        return redirect()->route('evento.index');
    }
}