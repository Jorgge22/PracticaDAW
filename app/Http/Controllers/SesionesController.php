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

    public function create()
    {
        // Obtener los planes del usuario autenticado
        $idCiclista = Auth::user()->id;
        $planes = DB::table('plan_entrenamiento')
            ->where('id_ciclista', $idCiclista)
            ->get();

        return view('sesiones.create', ['planes' => $planes]);
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'id_plan' => 'required|integer|exists:plan_entrenamiento,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'completada' => 'boolean'
        ]);

        // Validar que el plan pertenece al usuario autenticado
        $idCiclista = Auth::user()->id;
        $plan = DB::table('plan_entrenamiento')
            ->where('id', $validated['id_plan'])
            ->where('id_ciclista', $idCiclista)
            ->first();

        if (!$plan) {
            return redirect()->back()->with('error', 'El plan seleccionado no es válido');
        }

        // Insertar la nueva sesión
        DB::table('sesion_entrenamiento')->insert($validated);

        return redirect()->route('sesiones')->with('success', 'Sesión creada exitosamente');
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

        // Obtener los bloques de entrenamiento asociados a la sesión
        $bloques = DB::table('sesion_bloque as sb')
            ->join('bloque_entrenamiento as b', 'sb.id_bloque_entrenamiento', '=', 'b.id')
            ->where('sb.id_sesion_entrenamiento', $id)
            ->select('b.*', 'sb.orden', 'sb.repeticiones')
            ->orderBy('sb.orden')
            ->get();

        return view('sesiones.show', ['sesion' => $sesion, 'bloques' => $bloques]);
    }

    public function edit($id)
    {
        // Obtener la sesión a editar
        $idCiclista = Auth::user()->id;

        $sesion = DB::table('sesion_entrenamiento as s')
            ->join('plan_entrenamiento as p', 's.id_plan', '=', 'p.id')
            ->where('s.id', $id)
            ->where('p.id_ciclista', $idCiclista)
            ->select('s.*', 'p.nombre as plan_nombre')
            ->first();

        if (!$sesion) {
            abort(404);
        }

        // Obtener los planes del usuario autenticado
        $planes = DB::table('plan_entrenamiento')
            ->where('id_ciclista', $idCiclista)
            ->get();

        return view('sesiones.edit', ['sesion' => $sesion, 'planes' => $planes]);
    }

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'id_plan' => 'required|integer|exists:plan_entrenamiento,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'completada' => 'boolean'
        ]);

        // Validar que la sesión y el plan pertenecen al usuario autenticado
        $idCiclista = Auth::user()->id;
        $sesion = DB::table('sesion_entrenamiento as s')
            ->join('plan_entrenamiento as p', 's.id_plan', '=', 'p.id')
            ->where('s.id', $id)
            ->where('p.id_ciclista', $idCiclista)
            ->first();

        if (!$sesion) {
            abort(404);
        }

        // Validar que el nuevo plan también pertenece al usuario
        $plan = DB::table('plan_entrenamiento')
            ->where('id', $validated['id_plan'])
            ->where('id_ciclista', $idCiclista)
            ->first();

        if (!$plan) {
            return redirect()->back()->with('error', 'El plan seleccionado no es válido');
        }

        // Actualizar la sesión
        DB::table('sesion_entrenamiento')
            ->where('id', $id)
            ->update($validated);

        return redirect()->route('sesiones.show', $id)->with('success', 'Sesión actualizada exitosamente');
    }

    public function destroy($id)
    {
        // Validar que la sesión pertenece al usuario autenticado
        $idCiclista = Auth::user()->id;
        $sesion = DB::table('sesion_entrenamiento as s')
            ->join('plan_entrenamiento as p', 's.id_plan', '=', 'p.id')
            ->where('s.id', $id)
            ->where('p.id_ciclista', $idCiclista)
            ->first();

        if (!$sesion) {
            abort(404);
        }

        // Eliminar la sesión
        DB::table('sesion_entrenamiento')
            ->where('id', $id)
            ->delete();

        return redirect()->route('sesiones')->with('success', 'Sesión eliminada exitosamente');
    }
}