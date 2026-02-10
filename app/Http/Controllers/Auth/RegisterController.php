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
    // Eliminar "use RegistersUsers;" y hacerlo manual

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request.
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        Auth::login($user);

        return redirect($this->redirectPath());
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:ciclista'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return Ciclista::create([
            'nombre' => $data['name'], 
            'apellidos' => '', 
            'fecha_nacimiento' => now()->subYears(25), 
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
        return $this->redirectTo;
    }
}