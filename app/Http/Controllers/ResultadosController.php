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

    public function create()
    {
        // Obtener las bicicletas y sesiones disponibles para el formulario
        $bicicletas = DB::table('bicicleta')->get();
        $sesiones = DB::table('sesion_entrenamiento')->get();
        
        return view('resultados.create', ['bicicletas' => $bicicletas, 'sesiones' => $sesiones]);
    }

    public function store(Request $request)
    {
        // Validar los datos que se van a introducir
        $validar = $request->validate([
            'id_bicicleta' => 'required|integer|exists:bicicleta,id',
            'id_sesion' => 'required|integer|exists:sesion_entrenamiento,id',
            'fecha' => 'required|date',
            'duracion' => 'integer|min:0',
            'kilometros' => 'numeric|min:0',
            'recorrido' => 'string|max:255',
            'pulso_medio' => 'integer|min:0',
            'pulso_max' => 'integer|min:0',
            'potencia_media' => 'integer|min:0',
            'potencia_normalizada' => 'integer|min:0',
            'velocidad_media' => 'numeric|min:0',
            'puntos_estres_tss' => 'numeric|min:0',
            'factor_intensidad_if' => 'numeric|min:0',
            'ascenso_metros' => 'integer|min:0',
            'comentario' => 'string|max:500'
        ]);

        // Agregar el ID del ciclista autenticado
        $validar['id_ciclista'] = Auth::user()->id;

        // Insertar los nuevos valores
        DB::table('entrenamiento')->insert($validar);

        return redirect()->route('resultados');
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

    public function edit($id)
    {
        // Obtener el resultado específico
        $idCiclista = Auth::user()->id;
        $resultado = DB::table('entrenamiento')
            ->where('id', $id)
            ->where('id_ciclista', $idCiclista)
            ->first();

        if (!$resultado) {
            abort(404);
        }

        // Obtener las bicicletas y sesiones disponibles para el formulario
        $bicicletas = DB::table('bicicleta')->get();
        $sesiones = DB::table('sesion_entrenamiento')->get();

        return view('resultados.edit', [
            'resultado' => $resultado,
            'bicicletas' => $bicicletas,
            'sesiones' => $sesiones
        ]);
    }

    public function update(Request $request, $id)
    {
        $validar = $request->validate([
            'id_bicicleta' => 'required|integer|exists:bicicleta,id',
            'id_sesion' => 'required|integer|exists:sesion_entrenamiento,id',
            'fecha' => 'required|date',
            'duracion' => 'integer|min:0',
            'kilometros' => 'numeric|min:0',
            'recorrido' => 'string|max:255',
            'pulso_medio' => 'integer|min:0',
            'pulso_max' => 'integer|min:0',
            'potencia_media' => 'integer|min:0',
            'potencia_normalizada' => 'integer|min:0',
            'velocidad_media' => 'numeric|min:0',
            'puntos_estres_tss' => 'numeric|min:0',
            'factor_intensidad_if' => 'numeric|min:0',
            'ascenso_metros' => 'integer|min:0',
            'comentario' => 'string|max:500'
        ]);

        $idCiclista = Auth::user()->id;
        $resultado = DB::table('entrenamiento')
            ->where('id', $id)
            ->where('id_ciclista', $idCiclista)
            ->first();

        if (!$resultado) {
            abort(404);
        }

        DB::table('entrenamiento')
            ->where('id', $id)
            ->update($validar);

        return redirect()->route('resultados', $id);
    }

    public function destroy($id)
    {
        // Buscar el resultado por el id recibido
        $idCiclista = Auth::user()->id;
        $resultado = DB::table('entrenamiento')
            ->where('id', $id)
            ->where('id_ciclista', $idCiclista)
            ->first();

        if (!$resultado) {
            abort(404);
        }

        // Eliminar el resultado
        DB::table('entrenamiento')->where('id', $id)->delete();

        // Redirigir a la lista de resultados
        return redirect()->route('resultados');
    }
}
