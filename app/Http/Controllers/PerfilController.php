<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        // Obtiene el usuario autenticado
        $user = Auth::user();
        return view('perfil.edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        // Obtiene el usuario autenticado
        $user = Auth::user();

        // Valida los datos del formulario, permitiendo campos opcionales
        $validated = $request->validate([
            'nombre' => 'nullable|string|max:80',
            'apellidos' => 'nullable|string|max:80',
            'fecha_nacimiento' => 'nullable|date',
            'peso_base' => 'nullable|numeric|between:30,200',
            'altura_base' => 'nullable|integer|between:100,250',
            'email' => 'nullable|email|max:80|unique:ciclista,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Solo actualizar campos que no estén vacíos
        $data = array_filter($validated, function($value) {
            return !is_null($value) && $value !== '';
        });

        // Si se proporcionó una nueva contraseña, hashearla antes de guardar
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Actualizar el usuario con los datos validados
        $user->update($data);

        // Redirigir de vuelta al perfil con un mensaje de éxito
        return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente');
    }
}
