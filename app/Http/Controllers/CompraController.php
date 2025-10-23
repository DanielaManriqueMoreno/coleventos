<?php

namespace App\Http\Controllers;

use App\Models\Boleteria;
use App\Models\Compra;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CompraController extends Controller
{
    private $rules = [
        // 'evento_id' se toma del formulario oculto o de la ruta
        'localidad_id' => 'required|exists:localidad,id', // Tu tabla 'localidad'
        'cantidad_boletas' => 'required|integer|min:1|max:10', // RF8: Máximo 10
        'numero_tarjeta' => 'required|string|digits:15', // RF8: Dato de prueba
    ];

    private $attributes = [
        'localidad_id' => 'localidad',
        'cantidad_boletas' => 'cantidad de boletas',
        'numero_tarjeta' => 'número de tarjeta',
    ];

    /**
     * RF12: Muestra el historial de compras del usuario autenticado.
     */
    public function index()
    {
        $compras = Compra::with(['evento', 'localidad'])
            ->where('user_id', Auth::id())
            ->latest('fecha_compra')
            ->get();

        return view('comprador.compras.index', compact('compras'));
    }

    public function create(string $evento_id)
    {
        $evento = Evento::with(['boleteria.localidad'])->findOrFail($evento_id);
        return view('comprador.compras.create', compact('evento'));
    }



    /**
     * RF8, RF9, RF10: Procesa y guarda la compra.
     */
    public function store(Request $request)
    {
        // Añadimos 'evento_id' a las reglas si viene del formulario
        $currentRules = $this->rules;
        $currentRules['evento_id'] = 'required|exists:evento,id'; // Tu tabla 'evento'

        $validator = Validator::make($request->all(), $currentRules);
        $validator->setAttributeNames($this->attributes);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = $request->all();
        $cantidadComprar = (int)$data['cantidad_boletas'];
        $user = Auth::user(); // RF8: Asegura que esté autenticado

        try {
            DB::transaction(function () use ($data, $cantidadComprar, $user) {
                
                // 1. (RF10) Buscar y bloquear boletería
                $boleteria = Boleteria::where('evento_id', $data['evento_id'])
                                      ->where('localidad_id', $data['localidad_id'])
                                      ->lockForUpdate() // Evita concurrencia
                                      ->firstOrFail(); // Falla si no existe

                // 2. (RF10) Validar disponibilidad
                if ($boleteria->cantidad_disponible < $cantidadComprar) {
                    throw ValidationException::withMessages([
                        'error' => 'No hay suficientes boletas disponibles para la localidad seleccionada. Solo quedan ' . $boleteria->cantidad_disponible
                    ]);
                }

                // 3. (RF9) Descontar boletas
                $boleteria->cantidad_disponible -= $cantidadComprar;
                $boleteria->save();

                // 4. (RF8) Registrar la compra con todos los datos
                Compra::create([
                    'user_id' => $user->id, // Vincula al usuario y su documento
                    'evento_id' => $data['evento_id'],
                    'localidad_id' => $data['localidad_id'],
                    'cantidad_boletas' => $cantidadComprar,
                    'valor_total' => $boleteria->valor_boleta * $cantidadComprar,
                    'numero_tarjeta' => $data['numero_tarjeta'], // Método de pago prueba
                    'estado_transaccion' => 'EXITOSA', // Estado (Usa tu valor 'EXITOSA')
                    'fecha_compra' => now(),
                ]);
            });

            // Si todo OK, redirige al historial
            return redirect()->route('compras.index')->with('message', '¡Compra realizada exitosamente!');

        } catch (ValidationException $e) {
             // Si falló la validación de stock
             return redirect()->back()->withInput()->withErrors($e->errors());
        } catch (\Exception $e) {
            // Cualquier otro error durante la transacción
            return redirect()->back()->withInput()->with('warning', 'Ocurrió un error al procesar la compra: ' . $e->getMessage());
        }
    }
}
