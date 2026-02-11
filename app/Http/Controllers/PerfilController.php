<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    public function edit() 
    {
        $user = Auth::user();
        return view('perfil.edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nombre' => 'required|string|max:80',
            'apellidos' => 'required|string|max:80',
            'fecha_nacimiento' => 'required|date',
            'peso_base' => 'nullable|numeric|between:30,200',
            'altura_base' => 'nullable|integer|between:100,250',
            'email' => 'required|email|max:80|unique:ciclista,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('perfil.update');
    }
}
