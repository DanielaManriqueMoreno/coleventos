<?php

use App\Http\Controllers\EventoController;
use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocalidadController;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/evento/buscar', [EventoController::class, 'search'])->name('evento.search');

// Panel administrador

// Panel comprador
Route::get('/comprador/index', function () {
    return view('comprador.index');
})->name('comprador.index')->middleware('auth');

// Rutas de autenticación
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    
Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/index', function () {
        return view('admin.index');
    })->name('admin.index');

    Route::prefix('artista')->group(function(){
        Route::get('/index', [ArtistaController::class, 'index'])->name('artista.index');
        Route::get('/create', [ArtistaController::class, 'create'])->name('artista.create');
        Route::get('/edit/{id}', [ArtistaController::class, 'edit'])->name('artista.edit');
        Route::post('/store', [ArtistaController::class, 'store'])->name('artista.store');
        Route::put('/update/{id}', [ArtistaController::class, 'update'])->name('artista.update');
        Route::get('/destroy/{id}', [ArtistaController::class, 'destroy'])->name('artista.destroy');
    });

    Route::prefix('localidad')->group(function(){
        Route::get('/index', [LocalidadController::class, 'index'])->name('localidad.index');
        Route::get('/create', [LocalidadController::class, 'create'])->name('localidad.create');
        Route::get('/edit/{id}', [LocalidadController::class, 'edit'])->name('localidad.edit');
        Route::post('/store', [LocalidadController::class, 'store'])->name('localidad.store');
        Route::put('/update/{id}', [LocalidadController::class, 'update'])->name('localidad.update');
        Route::get('/destroy/{id}', [LocalidadController::class, 'destroy'])->name('localidad.destroy');
    });

    Route::prefix('evento')->group(function(){
        Route::get('/index', [EventoController::class, 'index'])->name('evento.index');
        Route::get('/create', [EventoController::class, 'create'])->name('evento.create');
        Route::get('/edit/{id}', [EventoController::class, 'edit'])->name('evento.edit');
        Route::post('/store', [EventoController::class, 'store'])->name('evento.store');
        Route::put('/update/{id}', [EventoController::class, 'update'])->name('evento.update');
        Route::get('/destroy/{id}', [EventoController::class, 'destroy'])->name('evento.destroy');
    });

});