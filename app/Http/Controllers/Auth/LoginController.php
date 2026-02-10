<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the login username to be used by the controller.
     * Por defecto es 'email', pero si tu columna tiene otro nombre, ajústalo.
     *
     * @return string
     */
    public function username()
    {
        return 'email'; // Si tu columna se llama 'correo' o similar, cámbialo aquí
    }

    /**
     * Get the guard to be used during authentication.
     * Esto asegura que use el guard configurado para ciclista.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Validate the user login request.
     * Puedes personalizar las reglas de validación si es necesario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Get the needed authorization credentials from the request.
     * Ajusta según los nombres de tus columnas.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }
}
