<?php

namespace App\Http\Controllers;

use App\Models\Boleteria;
use App\Models\Evento;
use App\Models\Localidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BoleteriaController extends Controller
{
    private $traductionAttributes = [
        'evento_id' => 'evento',
        'localidad_id' => 'localidad',
        'valor_boleta' => 'valor de la boleta',
        'cantidad_disponible' => 'cantidad disponible',
        'cantidad_inicial' => 'cantidad inicial',
    ];

    public function index()
    {
        // Cargar relaciones para mostrar nombres, no solo IDs
        $boleterias = Boleteria::with('evento', 'localidad')->get();
        return view('boleteria.index', compact('boleterias'));
    }

    public function create()
    {
        // Cargar eventos y localidades para los <select> del formulario
        $eventos = Evento::all();
        $localidades = Localidad::all();
        return view('boleteria.create', compact('eventos', 'localidades'));
    }

    public function store(Request $request)
    {
        $rules = [
            'evento_id' => [
                'required',
                'exists:eventos,id',
                Rule::unique('boleteria')->where(function ($query) use ($request) {
                    return $query->where('localidad_id', $request->localidad_id);
                }),
            ],
            'localidad_id' => 'required|exists:localidades,id',
            'valor_boleta' => 'required|numeric|min:0',
            'cantidad_disponible' => 'required|integer|min:0',
            'cantidad_inicial' => 'required|integer|min:0',
        ];

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($this->traductionAttributes);
        if ($validator->fails()) {
            return redirect()->route('boleteria.create')->withInput()->withErrors($validator);
        }

        Boleteria::create($request->all());
        session()->flash('message', 'Boletería configurada exitosamente');
        return redirect()->route('boleteria.index');
    }

    public function show(string $id)
    {
        return redirect()->route('boleteria.edit', $id);
    }

    public function edit(string $id)
    {
        $boleteria = Boleteria::find($id);
        if ($boleteria) {
            $eventos = Evento::all();
            $localidades = Localidad::all();
            return view('admin.boleteria.edit', compact('boleteria', 'eventos', 'localidades'));
        } else {
            session()->flash('warning', 'No se encuentra la configuración solicitada');
            return redirect()->route('boleteria.index');
        }
    }

    public function update(Request $request, string $id)
    {
        $rules = [
            'evento_id' => [
                'required',
                'exists:eventos,id',
                // Regla para clave única compuesta, ignorando el registro actual
                Rule::unique('boleteria')->where(function ($query) use ($request) {
                    return $query->where('localidad_id', $request->localidad_id);
                })->ignore($id),
            ],
            'localidad_id' => 'required|exists:localidades,id',
            'valor_boleta' => 'required|numeric|min:0',
            'cantidad_disponible' => 'required|integer|min:0',
            'cantidad_inicial' => 'required|integer|min:0',
        ];

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($this->traductionAttributes);
        if ($validator->fails()) {
            return redirect()->route('boleteria.edit', $id)->withInput()->withErrors($validator);
        }

        $boleteria = Boleteria::find($id);
        if ($boleteria) {
            $boleteria->update($request->all());
            session()->flash('message', 'Boletería actualizada exitosamente');
        } else {
            session()->flash('warning', 'No se encuentra la configuración solicitada');
        }

        return redirect()->route('boleteria.index');
    }

    public function destroy(string $id)
    {
        $boleteria = Boleteria::find($id);
        if ($boleteria) {
            $boleteria->delete();
            session()->flash('message', 'Configuración de boletería eliminada');
        } else {
            session()->flash('warning', 'No se encuentra la configuración solicitada');
        }

        return redirect()->route('boleteria.index');
    }
}
