<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PerfilController;
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

// Perfil del usuario
Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil')->middleware('auth'); //middleware para proteger la ruta y que solo usuarios autenticados puedan acceder

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