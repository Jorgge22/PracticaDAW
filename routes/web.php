<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Auth; 

Route::get('/', function () {
    return view('home');
});

// Ruta del menu (pagina principal con las listas)
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
// Mostrar contenido cuando se selecciona un menu o submenu
Route::get('/menu/{ruta}', [MenuController::class, 'show'])->name('menu.show');

// Rutas para el login y cierre de sesión
Route::get('/login', [LoginController::class, 'mostrarLogin'])->name('login.form');
Route::post('/login', [LoginController::class, 'procesarLogin'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'cerrarSesion'])->name('login.cerrar');

// Rutas para el registro
Route::get('/register', [LoginController::class, 'mostrarRegistro'])->name('register.form');
Route::post('/register', [LoginController::class, 'procesarRegistro'])->name('register.submit');

// Rutas para el menú dinámico
Route::prefix('api')->group(function () {
    Route::get('/menus', [MenuController::class, 'obtenerMenus']);
    Route::get('/planes', [MenuController::class, 'obtenerPlanes']);
    Route::get('/sesiones', [MenuController::class, 'obtenerSesiones']);
    Route::get('/bicicletas', [MenuController::class, 'obtenerBicicletas']);
    Route::get('/bloques', [MenuController::class, 'obtenerBloques']);
    Route::get('/resultados', [MenuController::class, 'obtenerResultados']);
    Route::get('/perfil', [MenuController::class, 'obtenerPerfil']);
});

Auth::routes(); // Esta línea ahora funcionará

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');