<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
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

    // Mostrar formulario de registro
    public function mostrarRegistro()
    {
        return view('register');
    }

    // Registro de nuevo ciclista
    public function procesarRegistro(Request $request)
    {
        // Por si esta repetido
        $data = $request->validate([
            'nombre' => 'required|string|max:80',
            'apellidos' => 'required|string|max:80',
            'fecha_nacimiento' => 'required|date',
            'email' => 'required|email|max:80|unique:ciclista,email', // mail unico en la tabla ciclista
            'password' => 'required|string|min:4',
        ]);

        try {
            // Intentar insertar el nuevo ciclista
            $inserted = DB::table('ciclista')->insert([
                'nombre' => $data['nombre'],
                'apellidos' => $data['apellidos'],
                'fecha_nacimiento' => $data['fecha_nacimiento'],
                'peso_base' => null,
                'altura_base' => null,
                'email' => $data['email'],
                'password' => $data['password'],
            ]);

            // TODO Si la insercion fue exitosa redirigir al login con mensaje de exito
            
        } catch (Exception $e) {
            // Si hay un error SQL u otro, mostrar mensaje de error
            return back()->withErrors(['error' => 'Error al registrar: ' . $e->getMessage()]);
        }
    }
}
