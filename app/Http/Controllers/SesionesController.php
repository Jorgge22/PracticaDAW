<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SesionesController extends Controller
{
    public function __construct()
    {
        // Solo los usuarios autenticados pueden acceder a las sesiones de entrenamiento
        $this->middleware('auth');
    }

    public function index()
    {
        // Obtener todas las sesiones de entrenamiento del ciclista autenticado, uniendo con el plan de entrenamiento para mostrar el nombre del plan
        $idCiclista = Auth::user()->id;

        $sesiones = DB::table('sesion_entrenamiento as s')
            ->join('plan_entrenamiento as p', 's.id_plan', '=', 'p.id')
            ->where('p.id_ciclista', $idCiclista)
            ->select('s.*', 'p.nombre as plan_nombre')
            ->get();

        // Mostrar la vista con la lista de sesiones de entrenamientos
        return view('sesiones.index', ['sesiones' => $sesiones]);
    }

    public function show($id)
    {
        // Obtener una sesión de entrenamiento específica por su ID, asegurándose de que pertenece al ciclista autenticado
        $idCiclista = Auth::user()->id;

        $sesion = DB::table('sesion_entrenamiento as s')
            ->join('plan_entrenamiento as p', 's.id_plan', '=', 'p.id')
            ->where('s.id', $id)
            ->where('p.id_ciclista', $idCiclista)
            ->select('s.*', 'p.nombre as plan_nombre')
            ->first();

        // Si no se encuentra la sesión de entrenamiento, mostrar un error 404
        if (!$sesion) {
            abort(404);
        }

        return view('sesiones.show', ['sesion' => $sesion]);
    }
}
