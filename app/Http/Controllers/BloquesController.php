<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BloquesController extends Controller
{
    public function __construct()
    {
        // Solo los usuarios autenticados pueden acceder a los bloques de entrenamiento
        $this->middleware('auth');
    }

    public function index()
    {
        // Obtener todos los bloques de entrenamiento de la base de datos
        $bloques = DB::table('bloque_entrenamiento')->get();
        return view('bloques.index', ['bloques' => $bloques]);
    }

    public function show($id)
    {
        // Obtener un bloque de entrenamiento específico por su ID
        $bloque = DB::table('bloque_entrenamiento')
            ->where('id', $id)
            ->first();

        // Si no se encuentra el bloque de entrenamiento, mostrar un error 404
        if (!$bloque) {
            abort(404);
        }

        return view('bloques.show', ['bloque' => $bloque]);
    }
}
