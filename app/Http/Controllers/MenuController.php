<?php

namespace App\Http\Controllers;

use App\Models\Ciclista;
use App\Models\PlanEntrenamiento;
use App\Models\SesionEntrenamiento;
use App\Models\BloqueEntrenamiento;
use App\Models\Bicicleta;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function index()
    {
        // Obtener el id del ciclista autenticado
        $idCiclista = Auth::user()->id;

        $planes = DB::table('plan_entrenamiento')
            ->where('id_ciclista', $idCiclista)
            ->get();

        $sesiones = DB::table('sesion_entrenamiento as s')
            ->join('plan_entrenamiento as p', 's.id_plan', '=', 'p.id')
            ->where('p.id_ciclista', $idCiclista)
            ->select('s.*', 'p.nombre as plan_nombre')
            ->get();

        $entrenamientos = DB::table('entrenamiento')
            ->where('id_ciclista', $idCiclista)
            ->get();

        $bicicletas = DB::table('bicicleta')->get();

        $bloques = DB::table('bloque_entrenamiento')->get();

        $historico = DB::table('historico_ciclista')
            ->where('id_ciclista', $idCiclista)
            ->orderBy('fecha', 'desc')
            ->get();

        return view('menu', [
            'planes' => $planes,
            'sesiones' => $sesiones,
            'entrenamiento' => $entrenamientos,
            'bicicletas' => $bicicletas,
            'bloques' => $bloques,
            'historico del ciclista' => $historico
        ]);
    }

    public function show($ruta)
    {
        return response()->json([
            'ruta' => $ruta,
            'contenido' => 'Contenido del menú: ' . $ruta
        ]);
    }

    public function obtenerMenus()
    {
        $idCiclista = Auth::user()->id;

        return response()->json([
            'planes' => [
                'nombre' => 'Mis Planes',
                'cantidad' => DB::table('plan_entrenamiento')->where('id_ciclista', $idCiclista)->count()
            ],
            'sesiones' => [
                'nombre' => 'Mis Sesiones',
                'cantidad' => DB::table('sesion_entrenamiento')
                    ->join('plan_entrenamiento', 'sesion_entrenamiento.id_plan', '=', 'plan_entrenamiento.id')
                    ->where('plan_entrenamiento.id_ciclista', $idCiclista)
                    ->count()
            ],
            'bicicletas' => [
                'nombre' => 'Bicicletas',
                'cantidad' => DB::table('bicicleta')->count()
            ],
            'bloques' => [
                'nombre' => 'Bloques',
                'cantidad' => DB::table('bloque_entrenamiento')->count()
            ],
            'resultados' => [
                'nombre' => 'Resultados',
                'cantidad' => DB::table('entrenamiento')->where('id_ciclista', $idCiclista)->count()
            ],
            'perfil' => [
                'nombre' => 'Mi Perfil',
                'cantidad' => 1
            ]
        ]);
    }

    public function obtenerPlanes()
    {
        $idCiclista = Auth::user()->id;
        $planes = DB::table('plan_entrenamiento')
            ->where('id_ciclista', $idCiclista)
            ->get();

        return response()->json($planes);
    }

    public function obtenerSesiones()
    {
        $idCiclista = Auth::user()->id;

        $sesiones = DB::table('sesion_entrenamiento as s')
            ->join('plan_entrenamiento as p', 's.id_plan', '=', 'p.id')
            ->where('p.id_ciclista', $idCiclista)
            ->select('s.*', 'p.nombre as plan_nombre')
            ->get();

        return response()->json($sesiones);
    }

    public function obtenerBicicletas()
    {
        $bicicletas = DB::table('bicicleta')->get();
        return response()->json($bicicletas);
    }

    public function obtenerBloques()
    {
        $bloques = DB::table('bloque_entrenamiento')->get();
        return response()->json($bloques);
    }

    public function obtenerResultados()
    {
        $idCiclista = Auth::user()->id;
        $resultados = DB::table('entrenamiento')
            ->where('id_ciclista', $idCiclista)
            ->get();

        return response()->json($resultados);
    }

    public function obtenerPerfil()
    {
        $idCiclista = Auth::user()->id;
        $perfil = DB::table('ciclista')
            ->where('id', $idCiclista)
            ->first();

        return response()->json($perfil);
    }
}
