<?php

namespace App\Http\Controllers; // Assuming this is your namespace

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
        // 'cantidad_inicial' no se valida, se calcula
    ];

    /**
     * Muestra la lista de configuraciones de boletería.
     */
    public function index()
    {
        $boleterias = Boleteria::with('evento', 'localidad')->get();
        // Usa la vista que corresponde a tu ruta admin.boleteria.index
        return view('admin.boleteria.index', compact('boleterias'));
    }

    /**
     * Muestra el formulario para crear la configuración.
     */
    public function create()
    {
        $eventos = Evento::orderBy('nombre')->get();
        $localidades = Localidad::orderBy('nombre_localidad')->get();
        // Usa la vista que corresponde a tu ruta admin.boleteria.create
        return view('admin.boleteria.create', compact('eventos', 'localidades'));
    }

    /**
     * Guarda la nueva configuración de boletería.
     */
    public function store(Request $request)
    {
        $rules = [
            'evento_id' => [
                'required',
                'exists:evento,id', // Usa el nombre de tu tabla 'evento'
                Rule::unique('boleteria')->where(function ($query) use ($request) {
                    return $query->where('localidad_id', $request->localidad_id);
                }),
            ],
            'localidad_id' => 'required|exists:localidad,id', // Usa el nombre de tu tabla 'localidad'
            'valor_boleta' => 'required|numeric|min:0',
            'cantidad_disponible' => 'required|integer|min:0',
        ];

        $messages = [
            'evento_id.unique' => 'Ya existe una configuración para este evento y localidad.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        $validator->setAttributeNames($this->traductionAttributes);
        if ($validator->fails()) {
            // ARREGLADO: Redirige a tu ruta 'admin.boleteria.create'
            return redirect()->route('admin.boleteria.create')->withInput()->withErrors($validator);
        }

        $data = $request->all();
        // CORRECCIÓN IMPORTANTE: Establece 'cantidad_inicial' al crear
        $data['cantidad_inicial'] = $data['cantidad_disponible'];

        Boleteria::create($data);

        session()->flash('message', 'Boletería configurada exitosamente');
        // ARREGLADO: Redirige a tu ruta 'admin.boleteria.index'
        return redirect()->route('admin.boleteria.index');
    }

    /**
     * Muestra el formulario para editar una configuración.
     */
    public function edit(string $id)
    {
        $boleteria = Boleteria::find($id);
        if ($boleteria) {
            $eventos = Evento::orderBy('nombre')->get();
            $localidades = Localidad::orderBy('nombre_localidad')->get();
            // Usa la vista que corresponde a tu ruta admin.boleteria.edit
            return view('admin.boleteria.edit', compact('boleteria', 'eventos', 'localidades'));
        }

        session()->flash('warning', 'No se encuentra la configuración solicitada');
        // ARREGLADO: Redirige a tu ruta 'admin.boleteria.index'
        return redirect()->route('admin.boleteria.index');
    }

    /**
     * Actualiza una configuración de boletería.
     */
    public function update(Request $request, string $id)
    {
        // La validación de 'update' necesita 'cantidad_inicial'
        $rules = [
            'evento_id' => [
                'required',
                'exists:evento,id', // Usa tu tabla 'evento'
                Rule::unique('boleteria')->where(function ($query) use ($request) {
                    return $query->where('localidad_id', $request->localidad_id);
                })->ignore($id),
            ],
            'localidad_id' => 'required|exists:localidad,id', // Usa tu tabla 'localidad'
            'valor_boleta' => 'required|numeric|min:0',
            'cantidad_disponible' => 'required|integer|min:0',
            'cantidad_inicial' => 'required|integer|min:0', // Necesaria para el update
        ];

        $messages = [
            'evento_id.unique' => 'Ya existe una configuración para este evento y localidad.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        $validator->setAttributeNames($this->traductionAttributes);
        if ($validator->fails()) {
            // ARREGLADO: Redirige a tu ruta 'admin.boleteria.edit'
            return redirect()->route('admin.boleteria.edit', $id)->withInput()->withErrors($validator);
        }

        $boleteria = Boleteria::find($id);
        if ($boleteria) {
            $boleteria->update($request->all());
            session()->flash('message', 'Boletería actualizada exitosamente');
        } else {
            session()->flash('warning', 'No se encuentra la configuración solicitada');
        }

        // ARREGLADO: Redirige a tu ruta 'admin.boleteria.index'
        return redirect()->route('admin.boleteria.index');
    }

    /**
     * Elimina una configuración de boletería.
     */
    public function destroy(string $id)
    {
        $boleteria = Boleteria::find($id);
        if ($boleteria) {
            $boleteria->delete();
            session()->flash('message', 'Configuración de boletería eliminada');
        } else {
            session()->flash('warning', 'No se encuentra la configuración solicitada');
        }

        // ARREGLADO: Redirige a tu ruta 'admin.boleteria.index'
        return redirect()->route('admin.boleteria.index');
    }
}