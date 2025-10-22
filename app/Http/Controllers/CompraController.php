<?php

namespace App\Http\Controllers;

use App\Models\Boleteria;
use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CompraController extends Controller
{
    // Reglas para el 'store' (RF8)
    private $rules = [
        'evento_id' => 'required|exists:eventos,id',
        'localidad_id' => 'required|exists:localidades,id',
        'cantidad_boletas' => 'required|integer|min:1|max:10', // RF8: Límite de 10
        'numero_tarjeta' => 'required|string|digits:15', // RF8: Dato de prueba
    ];

    private $traductionAttributes = [
        'evento_id' => 'evento',
        'localidad_id' => 'localidad',
        'cantidad_boletas' => 'cantidad de boletas',
        'numero_tarjeta' => 'número de tarjeta',
    ];

    /**
     * RF12: Muestra el historial de compras del usuario autenticado.
     */
    public function index()
    {
        $compras = Compra::where('user_id', Auth::id())
                        ->with('evento', 'localidad') // Carga relaciones
                        ->latest('fecha_compra')
                        ->get();
        
        return view('compras.index', compact('compras'));
    }

    /**
     * RF8, RF9, RF10: Procesa y almacena una nueva compra.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        $validator->setAttributeNames($this->traductionAttributes);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = Auth::user();
        $data = $request->all();
        $cantidadComprar = (int)$data['cantidad_boletas'];

        try {
            // Usamos una transacción para asegurar que el stock se descuente
            // solo si la compra se crea exitosamente.
            DB::transaction(function () use ($data, $user, $cantidadComprar) {
                
                // 1. (RF10) Buscar y bloquear la boletería para evitar concurrencia
                $boleteria = Boleteria::where('evento_id', $data['evento_id'])
                                      ->where('localidad_id', $data['localidad_id'])
                                      ->lockForUpdate() 
                                      ->firstOrFail();

                // 2. (RF10) Validar disponibilidad de boletas
                if ($boleteria->cantidad_disponible < $cantidadComprar) {
                    // Si no hay stock, lanzamos una excepción para cancelar la transacción
                    throw new \Exception('No hay suficientes boletas disponibles. Solo quedan ' . $boleteria->cantidad_disponible);
                }

                // 3. (RF9) Descontar boletas del stock
                $boleteria->cantidad_disponible -= $cantidadComprar;
                $boleteria->save();

                // 4. (RF8) Registrar la compra
                Compra::create([
                    'user_id' => $user->id,
                    'evento_id' => $data['evento_id'],
                    'localidad_id' => $data['localidad_id'],
                    'cantidad_boletas' => $cantidadComprar,
                    'valor_total' => $boleteria->valor_boleta * $cantidadComprar,
                    'numero_tarjeta' => $data['numero_tarjeta'],
                    'estado_transaccion' => 'EXITOSA', 
                    'fecha_compra' => now(),
                ]);
            });

            session()->flash('message', '¡Compra realizada exitosamente!');
            return redirect()->route('compras.index'); 

        } catch (\Exception $e) {
            session()->flash('warning', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
