<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Ciclista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Mostrar el formulario de registro
     */
    public function mostrarRegistro()
    {
        return view('auth.register');
    }

    /**
     * Procesar el registro
     */
    public function registrarse(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        Auth::login($user);

        return redirect($this->redirectPath());
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:80'],
            'apellido' => ['required', 'string', 'max:80'],
            'fecha_nacimiento' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:80', 'unique:ciclista'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return Ciclista::create([
            'nombre' => $data['nombre'], 
            'apellidos' => $data['apellido'], 
            'fecha_nacimiento' => $data['fecha_nacimiento'], 
            'peso_base' => null,
            'altura_base' => null,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Get the post register redirect path.
     */
    protected function redirectPath()
    {
        return '/home';
    }

    // Alias methods expected by Laravel's Auth routes
    public function showRegistrationForm()
    {
        return $this->mostrarRegistro();
    }

    public function register(Request $request)
    {
        return $this->registrarse($request);
    }
}