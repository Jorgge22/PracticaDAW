<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PlanesController extends Controller
{
    public function __construct()
    {
        // Solo los usuarios autenticados pueden acceder a los planes de entrenamiento
        $this->middleware('auth');
    }

    public function index()
    {
        // Obtener todos los planes de entrenamiento del ciclista autenticado
        $idCiclista = Auth::user()->id;
        $planes = DB::table('plan_entrenamiento')
            ->where('id_ciclista', $idCiclista)
            ->get();

        // Mostrar la vista con la lista de planes de entrenamiento
        return view('planes.index', ['planes' => $planes]);
    }

    public function show($id)
    {
        // Obtener un plan de entrenamiento específico por su ID, asegurándose de que pertenece al ciclista autenticado
        $idCiclista = Auth::user()->id;

        $plan = DB::table('plan_entrenamiento')
            ->where('id', $id)
            ->where('id_ciclista', $idCiclista)
            ->first();

        // Si no se encuentra el plan de entrenamiento, mostrar un error 404
        if (!$plan) {
            abort(404);
        }

        return view('planes.show', ['plan' => $plan]);
    }
}
