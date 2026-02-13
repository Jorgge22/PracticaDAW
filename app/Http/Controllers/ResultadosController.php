<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ResultadosController extends Controller
{
    public function __construct()
    {
        // Solo los usuarios autenticados pueden acceder a los resultados de entrenamiento
        $this->middleware('auth');
    }

    public function index()
    {
        // Obtener todos los resultados de entrenamiento del ciclista autenticado
        $idCiclista = Auth::user()->id;
        $resultados = DB::table('entrenamiento')
            ->where('id_ciclista', $idCiclista)
            ->get();

        // Mostrar la vista con la lista de resultados de entrenamiento
        return view('resultados.index', ['resultados' => $resultados]);
    }

    public function show($id)
    {
        // Obtener un resultado específico por su ID, asegurándose de que pertenece al ciclista autenticado
        $idCiclista = Auth::user()->id;
        $resultado = DB::table('entrenamiento')
            ->where('id', $id)
            ->where('id_ciclista', $idCiclista)
            ->first();

        // Si no se encuentra el resultado, mostrar un error 404
        if (!$resultado) {
            abort(404);
        }

        return view('resultados.show', ['resultado' => $resultado]);
    }
}
