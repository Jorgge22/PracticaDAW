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

        // Obtener los planes de entrenamiento del ciclista
        $planes = DB::table('plan_entrenamiento')
            ->where('id_ciclista', $idCiclista)
            ->get();
        
        // Obtener las sesiones con el nombre del plan
        $sesiones = DB::table('sesion_entrenamiento as s')
            ->join('plan_entrenamiento as p', 's.id_plan', '=', 'p.id')
            ->where('p.id_ciclista', $idCiclista)
            ->select('s.*', 'p.nombre as plan_nombre')
            ->get();

        // Obtener los entrenamientos del ciclista
        $entrenamientos = DB::table('entrenamiento')
            ->where('id_ciclista', $idCiclista)
            ->get();

        // Obtener las bicicletas del ciclista
        $bicicletas = DB::table('bicicleta')->get();

        // Obtener los bloques de entrenamiento
        $bloques = DB::table('bloque_entrenamiento')->get();

        // Obtener el histórico del ciclista
        $historico = DB::table('historico_ciclista')
            ->where('id_ciclista', $idCiclista)
            ->orderBy('fecha', 'desc')
            ->get();

            // Retornar la vista del menú con los datos obtenidos
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
        // Ejemplo de respuesta para cada ruta del menú
        return response()->json([
            'ruta' => $ruta,
            'contenido' => 'Contenido del menú: ' . $ruta
        ]);
    }

    public function obtenerMenus()
    {
        // Obtener el id del ciclista autenticado
        $idCiclista = Auth::user()->id;

        // Retornar la estructura del menú con los datos obtenidos
        return response()->json([
            'planes' => [
                'nombre' => 'Mis Planes', // Nombre del menú
                'cantidad' => DB::table('plan_entrenamiento')->where('id_ciclista', $idCiclista)->count() // Cantidad del ciclista
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
