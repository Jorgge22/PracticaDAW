<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Validar que el usuario tiene sesión, si no, redirigir a login
        if (!session()->has('id_ciclista')) {
            return redirect('/login');
        }

        // Devolver la vista con el esqueleto de menús
        // Los datos se cargarán dinámicamente con AJAX desde el cliente
        return view('menu');
    }
}
