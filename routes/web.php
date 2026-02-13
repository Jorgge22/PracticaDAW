<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PlanesController;
use App\Http\Controllers\SesionesController;
use App\Http\Controllers\BicicletasController;
use App\Http\Controllers\BloquesController;
use App\Http\Controllers\ResultadosController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

// Ruta principal que redirige al login o al home dependiendo de si el usuario está autenticado
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    } else {
        return redirect()->route('login');
    }
});

// Rutas de autenticación (login, registro, etc.)
Auth::routes();

// Pagina de inicio después de login
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Ruta para planes
Route::get('/planes', [PlanesController::class, 'index'])->name('planes')->middleware('auth');
Route::get('/planes/{id}', [PlanesController::class, 'show'])->name('planes.show')->middleware('auth');

// Rutas para sesiones
Route::get('/sesiones', [SesionesController::class, 'index'])->name('sesiones')->middleware('auth');
Route::get('/sesiones/{id}', [SesionesController::class, 'show'])->name('sesiones.show')->middleware('auth');

// Rutas para bicicletas
Route::get('/bicicletas', [BicicletasController::class, 'index'])->name('bicicletas')->middleware('auth');
Route::get('/bicicletas/{id}', [BicicletasController::class, 'show'])->name('bicicletas.show')->middleware('auth');

// Rutas para bloques de entrenamiento
Route::get('/bloques', [BloquesController::class, 'index'])->name('bloques')->middleware('auth');
Route::get('/bloques/{id}', [BloquesController::class, 'show'])->name('bloques.show')->middleware('auth');

// Rutas para resultados
Route::get('/resultados', [ResultadosController::class, 'index'])->name('resultados')->middleware('auth');
Route::get('/resultados/{id}', [ResultadosController::class, 'show'])->name('resultados.show')->middleware('auth');

// Perfil del usuario
Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil')->middleware('auth'); //middleware para proteger la ruta y que solo usuarios autenticados puedan acceder
Route::get('/perfil/edit', [PerfilController::class, 'edit'])->name('perfil.edit');
Route::put('/perfil/update', [PerfilController::class, 'update'])->name('perfil.update');

// Rutas para la API
Route::prefix('api')->group(function () {
    Route::get('/menus', [MenuController::class, 'obtenerMenus']);
    Route::get('/planes', [MenuController::class, 'obtenerPlanes']);
    Route::get('/sesiones', [MenuController::class, 'obtenerSesiones']);
    Route::get('/bicicletas', [MenuController::class, 'obtenerBicicletas']);
    Route::get('/bloques', [MenuController::class, 'obtenerBloques']);
    Route::get('/resultados', [MenuController::class, 'obtenerResultados']);
    Route::get('/perfil', [MenuController::class, 'obtenerPerfil']);
});