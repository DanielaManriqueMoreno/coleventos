@extends('templates.base')
@section('title', 'Panel del Comprador')
@section('header', 'Bienvenido al Panel del Comprador')

@section('content')
@include('templates.messages')

<div class="card shadow mb-4">
    <div class="card-body text-center">
        <h4>¡Hola, {{ Auth::user()->name }}!</h4>
        <p>Desde este panel puedes ver los <strong>eventos disponibles</strong> y tu <strong>historial de compras</strong>.</p>

        <a href="{{ route('comprador.eventos.index') }}" class="btn btn-primary m-2">
            <i class="fas fa-calendar-alt"></i> Ver Eventos
        </a>

        <a href="{{ route('compras.index') }}" class="btn btn-success m-2">
            <i class="fas fa-ticket-alt"></i> Mis Compras
        </a>
    </div>
</div>
@endsection
