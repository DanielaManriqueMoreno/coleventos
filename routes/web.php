<?php

use App\Http\Controllers\EventoController;
use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoleteriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\EventoArtistaController;
use App\Http\Controllers\EventoPublicController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
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
//  PANEL COMPRADOR
// =============================
Route::middleware(['auth'])->prefix('comprador')->name('comprador.')->group(function () {

    // Redirección desde /comprador/index hacia /comprador/index (listado de eventos)
    Route::get('/index', [EventoPublicController::class, 'index'])->name('index');

    // Ver evento
    Route::get('/evento/{id}', [EventoPublicController::class, 'show'])->name('show');

    // Compras
     Route::get('/comprar/{evento}', [CompraController::class, 'create'])->name('compras.create');
    Route::post('/comprar', [CompraController::class, 'store'])->name('compras.store');
    Route::get('/compras', [CompraController::class, 'index'])->name('compras.index');

    // Historial de compras
    Route::get('/compras', [CompraController::class, 'index'])->name('compras.index');
});    

// =============================
//GESTIÓN DE ARTISTAS
// =============================

Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    
    Route::get('/index', [DashboardController::class, 'index'])->name('admin.index');

    Route::prefix('evento/{evento}/artista')->name('evento.artista.')->group(function() { 
    Route::get('/create', [EventoArtistaController::class, 'create'])->name('create');
    Route::post('/store', [EventoArtistaController::class, 'store'])->name('store');
    Route::delete('/destroy/{artista}', [EventoArtistaController::class, 'destroy'])->name('destroy');
    });
    
    
    Route::get('/admin/evento/index', [EventoController::class, 'index'])->name('admin.evento.index');
    Route::get('/admin/evento/create', [EventoController::class, 'create'])->name('admin.evento.create');
    Route::post('/admin/evento/store', [EventoController::class, 'store'])->name('admin.evento.store');
    Route::get('/admin/evento/edit/{id}', [EventoController::class, 'edit'])->name('admin.evento.edit');
    Route::put('/admin/evento/update/{id}', [EventoController::class, 'update'])->name('admin.evento.update');
    Route::get('/admin/evento/destroy/{id}', [EventoController::class, 'destroy'])->name('admin.evento.destroy');

    // =============================
    // GESTIÓN DE ARTISTAS
    // =============================
    Route::get('/admin/artista/index', [ArtistaController::class, 'index'])->name('admin.artista.index');
    Route::get('/admin/artista/create', [ArtistaController::class, 'create'])->name('admin.artista.create');
    Route::post('/admin/artista/store', [ArtistaController::class, 'store'])->name('admin.artista.store');
    Route::get('/admin/artista/edit/{id}', [ArtistaController::class, 'edit'])->name('admin.artista.edit');
    Route::put('/admin/artista/update/{id}', [ArtistaController::class, 'update'])->name('admin.artista.update');
    Route::get('/admin/artista/destroy/{id}', [ArtistaController::class, 'destroy'])->name('admin.artista.destroy');

    // =============================
    // GESTIÓN DE LOCALIDADES
    // =============================
    Route::get('/admin/localidad/index', [LocalidadController::class, 'index'])->name('admin.localidad.index');
    Route::get('/admin/localidad/create', [LocalidadController::class, 'create'])->name('admin.localidad.create');
    Route::post('/admin/localidad/store', [LocalidadController::class, 'store'])->name('admin.localidad.store');
    Route::get('/admin/localidad/edit/{id}', [LocalidadController::class, 'edit'])->name('admin.localidad.edit');
    Route::put('/admin/localidad/update/{id}', [LocalidadController::class, 'update'])->name('admin.localidad.update');
    Route::get('/admin/localidad/destroy/{id}', [LocalidadController::class, 'destroy'])->name('admin.localidad.destroy');

    // =============================
    // GESTIÓN DE BOLETERÍA
    // =============================
    Route::get('/admin/boleteria/index', [BoleteriaController::class, 'index'])->name('admin.boleteria.index');
    Route::get('/admin/boleteria/create', [BoleteriaController::class, 'create'])->name('admin.boleteria.create');
    Route::post('/admin/boleteria/store', [BoleteriaController::class, 'store'])->name('admin.boleteria.store');
    Route::get('/admin/boleteria/edit/{id}', [BoleteriaController::class, 'edit'])->name('admin.boleteria.edit');
    Route::put('/admin/boleteria/update/{id}', [BoleteriaController::class, 'update'])->name('admin.boleteria.update');
    Route::get('/admin/boleteria/destroy/{id}', [BoleteriaController::class, 'destroy'])->name('admin.boleteria.destroy');

});
