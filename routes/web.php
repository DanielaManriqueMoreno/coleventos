<?php

use App\Http\Controllers\Admin\EventoController;
use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\EventoPublicController;
use Illuminate\Support\Facades\Route;

// =============================
// RUTAS PÚBLICAS
// =============================
Route::get('/', [HomeController::class, 'index'])->name('home');

// Búsqueda de eventos (pública)
Route::get('/evento/buscar', [EventoController::class, 'search'])->name('evento.search');

// =============================
// AUTENTICACIÓN
// =============================
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =============================
// PANEL ADMINISTRADOR
// =============================
Route::get('/admin/index', function () {
    return view('admin.index');
})->name('admin.index')->middleware('auth');

// =============================
//  PANEL COMPRADOR
// =============================
Route::get('/comprador/index', function () {
    return redirect()->route('comprador.eventos.index');
})->name('comprador.index')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    // Listado de eventos
    Route::get('/comprador/eventos', [EventoPublicController::class, 'index'])->name('comprador.eventos.index');
    // Ver evento
    Route::get('/comprador/eventos/{id}', [EventoPublicController::class, 'show'])->name('comprador.eventos.show');
    // Formulario de compra
    Route::get('/comprar/{evento}', [CompraController::class, 'create'])->name('compras.create');
    // Guardar compra
    Route::post('/comprar', [CompraController::class, 'store'])->name('compras.store');
    // Historial de compras
    Route::get('/compras', [CompraController::class, 'index'])->name('compras.index');
});

// =============================
//GESTIÓN DE ARTISTAS
// =============================
Route::prefix('artista')->group(function(){
    Route::get('/index', [ArtistaController::class, 'index'])->name('artista.index');
    Route::get('/create', [ArtistaController::class, 'create'])->name('artista.create');
    Route::get('/edit/{id}', [ArtistaController::class, 'edit'])->name('artista.edit');
    Route::post('/store', [ArtistaController::class, 'store'])->name('artista.store');
    Route::put('/update/{id}', [ArtistaController::class, 'update'])->name('artista.update');
    Route::get('/destroy/{id}', [ArtistaController::class, 'destroy'])->name('artista.destroy');
});

// =============================
// GESTIÓN DE LOCALIDADES
// =============================
Route::prefix('localidad')->group(function(){
    Route::get('/index', [LocalidadController::class, 'index'])->name('localidad.index');
    Route::get('/create', [LocalidadController::class, 'create'])->name('localidad.create');
    Route::get('/edit/{id}', [LocalidadController::class, 'edit'])->name('localidad.edit');
    Route::post('/store', [LocalidadController::class, 'store'])->name('localidad.store');
    Route::put('/update/{id}', [LocalidadController::class, 'update'])->name('localidad.update');
    Route::get('/destroy/{id}', [LocalidadController::class, 'destroy'])->name('localidad.destroy');
});

// =============================
//GESTIÓN DE EVENTOS (ADMIN)
// =============================
Route::prefix('evento')->group(function(){
    Route::get('/index', [EventoController::class, 'index'])->name('evento.index');
    Route::get('/create', [EventoController::class, 'create'])->name('evento.create');
    Route::get('/edit/{id}', [EventoController::class, 'edit'])->name('evento.edit');
    Route::post('/store', [EventoController::class, 'store'])->name('evento.store');
    Route::put('/update/{id}', [EventoController::class, 'update'])->name('evento.update');
    Route::get('/destroy/{id}', [EventoController::class, 'destroy'])->name('evento.destroy');
});
