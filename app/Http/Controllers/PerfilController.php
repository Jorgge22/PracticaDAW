<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function __construct()
    {
        // Solo los usuarios autenticados puedan acceder a las rutas de este controlador
        $this->middleware('auth');
    }

    public function index()
    {
        // Obtiene el usuario autenticado
        $usuario = Auth::user();
        
        // Retorna la vista del perfil con los datos del usuario
        return view('perfil.index', [
            'usuario' => $usuario
        ]);
    }
}
