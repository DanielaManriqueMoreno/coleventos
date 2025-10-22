<?php

namespace App\Http\Controllers;

use App\Models\Localidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LocalidadController extends Controller
{
    // Solo para las traducciones, las reglas se definirán en store/update
    private $traductionAttributes = [
        'codigo_localidad' => 'código de localidad',
        'nombre_localidad' => 'nombre de localidad',
    ];

    public function index()
    {
        $localidades = Localidad::all();
        return view('localidad.index', compact('localidades'));
    }

    public function create()
    {
        return view('localidad.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'codigo_localidad' => 'required|string|max:50|unique:localidades,codigo_localidad',
            'nombre_localidad' => 'required|string|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($this->traductionAttributes);
        if ($validator->fails()) {
            return redirect()->route('localidad.create')->withInput()->withErrors($validator);
        }

        Localidad::create($request->all());
        session()->flash('message', 'Localidad creada exitosamente');
        return redirect()->route('localidad.index');
    }

    public function show(string $id)
    {
        return redirect()->route('localidad.edit', $id);
    }

    public function edit(string $id)
    {
        $localidad = Localidad::find($id);
        if ($localidad) {
            return view('localidad.edit', compact('localidad'));
        } else {
            session()->flash('warning', 'No se encuentra la localidad solicitada');
            return redirect()->route('localidad.index');
        }
    }

    public function update(Request $request, string $id)
    {
        $rules = [
            // Ignora el registro actual ($id) al validar que sea único
            'codigo_localidad' => ['required', 'string', 'max:50', Rule::unique('localidades')->ignore($id)],
            'nombre_localidad' => 'required|string|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($this->traductionAttributes);
        if ($validator->fails()) {
            return redirect()->route('localidad.edit', $id)->withInput()->withErrors($validator);
        }

        $localidad = Localidad::find($id);
        if ($localidad) {
            $localidad->update($request->all());
            session()->flash('message', 'Localidad actualizada exitosamente');
        } else {
            session()->flash('warning', 'No se encuentra la localidad solicitada');
        }

        return redirect()->route('localidad.index');
    }

    public function destroy(string $id)
    {
        $localidad = Localidad::find($id);
        if ($localidad) {
            $localidad->delete();
            session()->flash('message', 'Localidad eliminada exitosamente');
        } else {
            session()->flash('warning', 'No se encuentra la localidad solicitada');
        }

        return redirect()->route('localidad.index');
    }
}
