<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArtistaController extends Controller
{
    private $rules = [
        'nombres' => 'required|string|max:100',
        'apellidos' => 'required|string|max:100',
        'genero_musical' => 'required|string|max:100',
        'ciudad_natal' => 'required|string|max:100',
    ];

    private $traductionAttributes = [
        'nombres' => 'nombres',
        'apellidos' => 'apellidos',
        'genero_musical' => 'género musical',
        'ciudad_natal' => 'ciudad natal',
    ];

    public function index()
    {
        $artistas = Artista::all();
        return view('admin.artista.index', compact('artistas'));
    }

    public function create()
    {
        return view('admin.artista.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        $validator->setAttributeNames($this->traductionAttributes);
        
        if ($validator->fails()) {
            return redirect()->route('artista.create')->withInput()->withErrors($validator);
        }

        Artista::create($request->all());
        session()->flash('message', 'Artista creado exitosamente');
        return redirect()->route('artista.index');
    }

    public function show(string $id)
    {
        return redirect()->route('artista.edit', $id);
    }

    public function edit(string $id)
    {
        $artista = Artista::find($id);
        
        if ($artista) {
            return view('admin.artista.edit', compact('artista'));
        }
        
        session()->flash('warning', 'No se encuentra el artista solicitado');
        return redirect()->route('artista.index');
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), $this->rules);
        $validator->setAttributeNames($this->traductionAttributes);
        
        if ($validator->fails()) {
            return redirect()->route('artista.edit', $id)->withInput()->withErrors($validator);
        }

        $artista = Artista::find($id);
        
        if ($artista) {
            $artista->update($request->all());
            session()->flash('message', 'Artista actualizado exitosamente');
        } else {
            session()->flash('warning', 'No se encuentra el artista solicitado');
        }

        return redirect()->route('artista.index');
    }

    public function destroy(string $id)
    {
        $artista = Artista::find($id);
        
        if ($artista) {
            $artista->delete();
            session()->flash('message', 'Artista eliminado exitosamente');
        } else {
            session()->flash('warning', 'No se encuentra el artista solicitado');
        }

        return redirect()->route('artista.index');
    }
}