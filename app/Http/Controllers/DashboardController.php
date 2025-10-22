<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; // ¡Importante! Usaremos DB::table()
use App\Models\Evento;
use App\Models\Artista;

class DashboardController extends Controller
{
    public function index()
    {
        // Total de eventos
        $totalEventos = Evento::count();
        
        // Total de artistas
        $totalArtistas = Artista::count();

        // Total de boletas vendidas
        $totalBoletasVendidas = DB::table('compra')
                                  ->where('estado_transaccion', 'EXITOSA')
                                  ->sum('cantidad_boletas');
        
        // Total de ingresos
        $totalIngresos = DB::table('compra')
                             ->where('estado_transaccion', 'EXITOSA')
                             ->sum('valor_total');
        
        // Boletas vendidas por evento (Top 5)
        $boletasPorEvento = DB::table('evento')
            ->select('evento.nombre', DB::raw('SUM(compra.cantidad_boletas) as total_vendidas'))
            ->leftJoin('compra', 'evento.id', '=', 'compra.evento_id')
            ->where('compra.estado_transaccion', 'EXITOSA')
            ->groupBy('evento.id', 'evento.nombre')
            ->orderBy('total_vendidas', 'desc')
            ->limit(5)
            ->get();
        
        // Ventas por mes (últimos 6 meses)
        $ventasPorMes = DB::table('compra')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as mes'),
                DB::raw('COUNT(*) as total') // Tu vista JS espera 'total'
            )
            ->where('estado_transaccion', 'EXITOSA')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();
        
        // Eventos próximos
        $eventosProximos = Evento::where('fecha_hora_inicio', '>=', now())
            ->orderBy('fecha_hora_inicio')
            ->limit(5)
            ->get();
        
        // Distribución por tipo de localidad
        $boletasPorLocalidad = DB::table('localidad')
            ->select('localidad.nombre_localidad', DB::raw('SUM(compra.cantidad_boletas) as total'))
            ->leftJoin('compra', 'localidad.id', '=', 'compra.localidad_id')
            ->where('compra.estado_transaccion', 'EXITOSA')
            ->groupBy('localidad.id', 'localidad.nombre_localidad')
            ->get();

        // Devolvemos la vista 'admin.index'
        return view('admin.index', compact(
            'totalEventos',
            'totalBoletasVendidas',
            'totalArtistas',
            'totalIngresos',
            'boletasPorEvento',
            'ventasPorMes',
            'eventosProximos',
            'boletasPorLocalidad'
        ));
    }
}