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

    public function create()
    {
        return view('bloques.create');
    }

    public function store(Request $request)
    {
        // Validar los datos que se van a introducir
        $validar = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'string|max:500',
            'tipo' => 'required|in:rodaje,intervalos,fuerza,recuperacion,test',
            'duracion_estimada' => 'integer|min:0',
            'potencia_pct_min' => 'integer|min:0|max:100',
            'potencia_pct_max' => 'integer|min:0|max:100',
            'pulso_pct_max' => 'integer|min:0|max:100',
            'pulso_reserva_pct' => 'integer|min:0|max:100',
            'comentario' => 'string|max:500'
        ]);

        // Insertar los nuevos valores
        DB::table('bloque_entrenamiento')->insert($validar);

        return redirect()->route('bloques');
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

    public function edit($id)
    {
        $bloque = DB::table('bloque_entrenamiento')
            ->where('id', $id)
            ->first();

        if (!$bloque) {
            abort(404);
        }

        return view('bloques.edit', ['bloque' => $bloque]);
    }

    public function update(Request $request, $id)
    {
        $validar = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'string|max:500',
            'tipo' => 'required|in:rodaje,intervalos,fuerza,recuperacion,test',
            'duracion_estimada' => 'integer|min:0',
            'potencia_pct_min' => 'integer|min:0|max:100',
            'potencia_pct_max' => 'integer|min:0|max:100',
            'pulso_pct_max' => 'integer|min:0|max:100',
            'pulso_reserva_pct' => 'integer|min:0|max:100',
            'comentario' => 'string|max:500'
        ]);

        $bloque = DB::table('bloque_entrenamiento')
            ->where('id', $id)
            ->first();

        if (!$bloque) {
            abort(404);
        }

        DB::table('bloque_entrenamiento')
            ->where('id', $id)
            ->update($validar);

        return redirect()->route('bloques', $id);
    }

    public function destroy($id)
    {
        // Buscar el bloque de entrenamiento por el id recibido
        $bloque = DB::table('bloque_entrenamiento')->where('id', $id)->first();

        if (!$bloque) {
            abort(404);
        }

        // Eliminar el bloque de entrenamiento
        DB::table('bloque_entrenamiento')->where('id', $id)->delete();

        // Redirigir a la lista de bloques
        return redirect()->route('bloques');
    }
}
