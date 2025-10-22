<?php

namespace App\Http\Controllers;

use App\Models\Boleteria;
use App\Models\Compra;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CompraController extends Controller
{
    // Reglas de validación
    private $rules = [
        'evento_id' => 'required|exists:evento,id',
        'localidad_id' => 'required|exists:localidad,id',
        'cantidad_boletas' => 'required|integer|min:1|max:10',
        'numero_tarjeta' => 'required|string|digits:15',
    ];

    private $attributes = [
        'evento_id' => 'evento',
        'localidad_id' => 'localidad',
        'cantidad_boletas' => 'cantidad de boletas',
        'numero_tarjeta' => 'número de tarjeta',
    ];

    // Historial de compras del usuario
    public function index()
    {
        $compras = Compra::with(['evento', 'localidad'])
            ->where('user_id', Auth::id())
            ->latest('fecha_compra')
            ->get();

        return view('compras.index', compact('compras'));
    }

    // Mostrar formulario de compra
    public function create($evento_id)
    {
        $evento = Evento::with(['boleterias.localidad'])->findOrFail($evento_id);

        // Extraemos solo la info necesaria de las localidades
        $localidades = $evento->boleterias->map(function($b) {
            return [
                'id' => $b->localidad->id,
                'nombre_localidad' => $b->localidad->nombre_localidad,
                'valor_boleta' => $b->valor_boleta,
                'cantidad_disponible' => $b->cantidad_disponible,
            ];
        });

        return view('comprador.compras.create', compact('evento', 'localidades'));
    }

    // Guardar compra
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        $validator->setAttributeNames($this->attributes);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = $request->all();
        $cantidadComprar = (int)$data['cantidad_boletas'];

        try {
            DB::transaction(function () use ($data, $cantidadComprar) {
                // Bloquear la boletería para evitar concurrencia
                $boleteria = Boleteria::where('evento_id', $data['evento_id'])
                    ->where('localidad_id', $data['localidad_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($boleteria->cantidad_disponible < $cantidadComprar) {
                    throw new \Exception('No hay suficientes boletas disponibles. Solo quedan ' . $boleteria->cantidad_disponible);
                }

                // Descontar stock
                $boleteria->cantidad_disponible -= $cantidadComprar;
                $boleteria->save();

                // Crear la compra
                Compra::create([
                    'user_id' => Auth::id(),
                    'evento_id' => $data['evento_id'],
                    'localidad_id' => $data['localidad_id'],
                    'cantidad_boletas' => $cantidadComprar,
                    'valor_total' => $boleteria->valor_boleta * $cantidadComprar,
                    'numero_tarjeta' => $data['numero_tarjeta'],
                    'estado_transaccion' => 'EXITOSA',
                    'fecha_compra' => now(),
                ]);
            });

            return redirect()->route('compras.index')->with('message', 'Compra realizada exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('warning', $e->getMessage());
        }
    }
}
