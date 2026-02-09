<?php

namespace App\Http\Controllers;

use App\Models\Ciclista;
use App\Models\PlanEntrenamiento;
use App\Models\SesionEntrenamiento;
use App\Models\BloqueEntrenamiento;
use App\Models\Bicicleta;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;      
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function index()
    {
        // Validar que el usuario tiene sesión, si no, redirigir a login
        if (!session()->has('id_ciclista')) {
            return redirect('/login');
        }

        // Obtener el id del ciclista
        $idCiclista = session('id_ciclista');

        $planes = DB::table('plan_entrenamiento')
            ->where('id_ciclista', $idCiclista)
            ->get();

        return view('menu', ['planes' => $planes]);
    }

    public function show($ruta)
    {
        // Validar que el usuario tiene sesión
        if (!session()->has('id_ciclista')) {
            return redirect('/login');
        }
        return response()->json([
            'ruta' => $ruta,
            'contenido' => 'Contenido del menú: ' . $ruta
        ]);
    }


}
