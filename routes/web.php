<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('home') : redirect()->route('login');
});

// Rutas de autenticación (login, registro, etc.)
Auth::routes();

// Pagina de inicio después de login
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/edit', [PerfilController::class, 'edit'])->name('perfil.edit');
Route::put('/update', [PerfilController::class, 'update'])->name('perfil.update');

// Perfil del usuario
Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil')->middleware('auth');

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