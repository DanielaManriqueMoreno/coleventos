@extends('templates.base')
@section('title', 'Dashboard')
@section('header', 'Dashboard - Panel de Control')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('content')

@include('templates.messages')

{{-- Tarjetas de Estadísticas --}}
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-stats primary shadow h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Total Eventos</div>
                        <div class="stat-value">{{ $totalEventos }}</div>
                        <div class="stat-change">
                            <i class="fas fa-arrow-up"></i> Activo
                        </div>
                    </div>
                    <div class="stat-icon primary">
                        <i class="fas fa-calendar"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-stats success shadow h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Boletas Vendidas</div>
                        <div class="stat-value">{{ number_format($totalBoletasVendidas) }}</div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> En venta
                        </div>
                    </div>
                    <div class="stat-icon success">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-stats info shadow h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Total Artistas</div>
                        <div class="stat-value">{{ $totalArtistas }}</div>
                        <div class="stat-change">
                            <i class="fas fa-users"></i> Registrados
                        </div>
                    </div>
                    <div class="stat-icon info">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-stats warning shadow h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Ingresos Totales</div>
                        <div class="stat-value">${{ number_format($totalIngresos, 0, ',', '.') }}</div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> +12.5%
                        </div>
                    </div>
                    <div class="stat-icon warning">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Gráficas --}}
<div class="row">
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card card-chart shadow h-100">
            <div class="card-header">
                <h6 class="card-title">
                    <i class="fas fa-chart-bar text-primary"></i>
                    Top 5 - Eventos con Más Boletas Vendidas
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="chartBoletasPorEvento"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card card-chart shadow h-100">
            <div class="card-header">
                <h6 class="card-title">
                    <i class="fas fa-chart-line text-success"></i>
                    Ventas por Mes (Últimos 6 Meses)
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="chartVentasPorMes"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card card-chart shadow h-100">
            <div class="card-header">
                <h6 class="card-title">
                    <i class="fas fa-chart-pie text-info"></i>
                    Distribución por Tipo de Localidad
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="chartBoletasPorLocalidad"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card card-chart shadow h-100">
            <div class="card-header">
                <h6 class="card-title">
                    <i class="fas fa-calendar-alt text-warning"></i>
                    Próximos Eventos
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-dashboard">
                        <thead>
                            <tr>
                                <th>Evento</th>
                                <th>Fecha</th>
                                <th>Ubicación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($eventosProximos as $evento)
                            <tr>
                                <td>
                                    <strong>{{ $evento->nombre }}</strong>
                                </td>
                                <td>
                                    <span class="badge badge-primary">
                                        {{ \Carbon\Carbon::parse($evento->fecha_hora_inicio)->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td>
                                    <i class="fas fa-map-marker-alt text-muted"></i>
                                    {{ $evento->municipio }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    <i class="fas fa-calendar-times fa-2x mb-2"></i>
                                    <p>No hay eventos próximos</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Configuración global de Chart.js
Chart.defaults.font.family = "'Nunito', sans-serif";
Chart.defaults.color = '#858796';

// Gráfica de Boletas por Evento
const boletasPorEvento = {
    labels: {!! json_encode($boletasPorEvento->pluck('nombre')) !!},
    datasets: [{
        label: 'Boletas Vendidas',
        data: {!! json_encode($boletasPorEvento->pluck('total_vendidas')) !!},
        backgroundColor: [
            'rgba(78, 115, 223, 0.8)',
            'rgba(28, 200, 138, 0.8)',
            'rgba(54, 185, 204, 0.8)',
            'rgba(246, 194, 62, 0.8)',
            'rgba(231, 74, 59, 0.8)'
        ],
        borderColor: [
            'rgba(78, 115, 223, 1)',
            'rgba(28, 200, 138, 1)',
            'rgba(54, 185, 204, 1)',
            'rgba(246, 194, 62, 1)',
            'rgba(231, 74, 59, 1)'
        ],
        borderWidth: 2,
        borderRadius: 8
    }]
};

new Chart(document.getElementById('chartBoletasPorEvento'), {
    type: 'bar',
    data: boletasPorEvento,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: 'rgba(0,0,0,0.8)',
                padding: 12,
                cornerRadius: 8
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0,0,0,0.05)'
                },
                ticks: {
                    callback: function(value) {
                        if (value % 1 === 0) return value;
                    }
                }
            },
            x: {
                grid: { display: false }
            }
        }
    }
});

// Gráfica de Ventas por Mes
const ventasPorMes = {
    labels: {!! json_encode($ventasPorMes->pluck('mes')) !!},
    datasets: [{
        label: 'Total Transacciones',
        data: {!! json_encode($ventasPorMes->pluck('total')) !!},
        borderColor: 'rgba(28, 200, 138, 1)',
        backgroundColor: 'rgba(28, 200, 138, 0.1)',
        borderWidth: 3,
        tension: 0.4,
        fill: true,
        pointRadius: 5,
        pointBackgroundColor: 'rgba(28, 200, 138, 1)',
        pointBorderColor: '#fff',
        pointBorderWidth: 2,
        pointHoverRadius: 7
    }]
};

new Chart(document.getElementById('chartVentasPorMes'), {
    type: 'line',
    data: ventasPorMes,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: 'rgba(0,0,0,0.8)',
                padding: 12,
                cornerRadius: 8
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0,0,0,0.05)'
                },
                ticks: {
                    callback: function(value) {
                        if (value % 1 === 0) return value;
                    }
                }
            },
            x: {
                grid: { display: false }
            }
        }
    }
});

// Gráfica de Boletas por Localidad
const boletasPorLocalidad = {
    labels: {!! json_encode($boletasPorLocalidad->pluck('nombre_localidad')) !!},
    datasets: [{
        label: 'Boletas Vendidas',
        data: {!! json_encode($boletasPorLocalidad->pluck('total')) !!},
        backgroundColor: [
            'rgba(78, 115, 223, 0.8)',
            'rgba(28, 200, 138, 0.8)',
            'rgba(54, 185, 204, 0.8)',
            'rgba(246, 194, 62, 0.8)',
            'rgba(231, 74, 59, 0.8)'
        ],
        borderColor: '#fff',
        borderWidth: 3
    }]
};

new Chart(document.getElementById('chartBoletasPorLocalidad'), {
    type: 'doughnut',
    data: boletasPorLocalidad,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'right',
                labels: {
                    padding: 15,
                    usePointStyle: true,
                    font: { size: 12 }
                }
            },
            tooltip: {
                backgroundColor: 'rgba(0,0,0,0.8)',
                padding: 12,
                cornerRadius: 8
            }
        }
    }
});
</script>
@endsection