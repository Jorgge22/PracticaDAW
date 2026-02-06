<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function mostrarLogin()
    {
        // La peticion pasa por el controlador y devuelve directamente la vista de login
        return view('login');
    }

    public function procesarLogin(Request $request)
    {
        // Recibimos los datos que se han escrito en el formulario
        $nombre = $request->input('nombre');
        $contraseña = $request->input('contraseña');

        // Comprobamos los datos introducimos con los datos que hay en la base de datos
        $ciclista = DB::table('ciclista')
            ->where('nombre', $nombre)
            ->where('password', $contraseña)
            ->first();

        if (!$ciclista) {
            // Mensaje de error
            return back()->withErrors(['error' => 'Credenciales incorrectas']);
        } else {
            // Si el objecto ciclista existe con el nombre y contraseña correcto se crea la sesion y se redirige a la pantalla principal
            session(['id_ciclista' => $ciclista->id]);
            return redirect('/menu');
        }
    }

    public function cerrarSesion()
    {
        // Olvidamos la sesión antes creada y redirigimos a la página de login
        session()->forget('id_ciclista');
        return redirect('/login');
    }
}
