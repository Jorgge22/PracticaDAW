<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MenuController;

Route::get('/', function () {
    return view('welcome');
});

// Ruta del menu (pagina principal con las listas)
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
// Mostrar contenido cuando se selecciona un menu o submenu
Route::get('/menu/{ruta}', [MenuController::class, 'show'])->name('menu.show');

// Rutas para el Login
Route::get('/login', [LoginController::class, 'mostrarLogin'])->name('login.form');
Route::post('/login', [LoginController::class, 'procesarLogin'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'cerrarSesion'])->name('login.cerrar');
