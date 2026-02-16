<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BicicletasController extends Controller
{
    public function __construct()
    {
        // Solo los usuarios autenticados pueden acceder a las bicicletas
        $this->middleware('auth');
    }

    public function index()
    {
        // Obtener todas las bicicletas de la base de datos
        $bicicletas = DB::table('bicicleta')->get();
        return view('bicicletas.index', ['bicicletas' => $bicicletas]);
    }

    public function show($id)
    {
        // Obtener una bicicleta específica por su ID
        $bicicleta = DB::table('bicicleta')
            ->where('id', $id)
            ->first();

        // Si no se encuentra la bicicleta, mostrar un error 404
        if (!$bicicleta) {
            abort(404);
        }

        // Mostrar la vista con los detalles de la bicicleta
        return view('bicicletas.show', ['bicicleta' => $bicicleta]);
    }

    public function create () {
        return view('bicicletas.store');
    }

    public function store (Request $request) {
        // Validar los datos que se van a introducir
        $validar = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:carretera,mtb,gravel,rodillo',
            'comentario' => 'required|string|max:255'
        ]);

        // Insertar los nuevos valores
        DB::table('bicicleta')->insert($validar);

        return redirect()->route('bicicletas');
    }

    public function edit () {

    }

    public function update (){
        
    }

    public function destroy () {
        
    }
}
