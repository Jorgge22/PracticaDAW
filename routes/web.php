<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController; 
Route::get('/', function () {
    return view('welcome');
});

// Rutas para el Login
Route::get('/login', [LoginController::class, 'mostrarLogin'])->name('login.form');
Route::post('/login', [LoginController::class, 'procesarLogin'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'cerrarSesion'])->name('login.cerrar');
