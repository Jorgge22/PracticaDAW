<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutenticarController extends Controller
{
    public function mostrarLogin()
    {
        // La peticion pasa por el controlador devuelve directamente la vista de login
        return view('login'); 
    }

    public function procesarLogin()
    {

    }

    public function cerrarSesion()
    {
        
    }
}
