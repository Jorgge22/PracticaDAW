<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MenuController;

Route::get('/', function () {
    return view('login');
});

// Ruta del menu (pagina principal con las listas)
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
// Mostrar contenido cuando se selecciona un menu o submenu
Route::get('/menu/{ruta}', [MenuController::class, 'show'])->name('menu.show');

// Rutas API para obtener menús dinámicos desde BD
Route::get('/api/menus', [MenuController::class, 'obtenerMenus'])->name('api.menus');
Route::get('/api/planes', [MenuController::class, 'obtenerPlanes'])->name('api.planes');
Route::get('/api/sesiones', [MenuController::class, 'obtenerSesiones'])->name('api.sesiones');

// Rutas para el login, registro y cierre de sesión
Route::get('/login', [LoginController::class, 'mostrarLogin'])->name('login.form');
Route::post('/login', [LoginController::class, 'procesarLogin'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'cerrarSesion'])->name('login.cerrar');
Route::get('/register', [LoginController::class, 'mostrarRegistro'])->name('register.form');
Route::post('/register', [LoginController::class, 'procesarRegistro'])->name('register.submit');
