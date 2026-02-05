<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticarController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AutenticarController::class, 'mostrarLogin'])->name('login.form');
Route::post('/login', [AutenticarController::class, 'procesarLogin'])->name('login.submit');
Route::post('/login', [AutenticarController::class, 'cerrarSesion'])->name('login.cerrar');
