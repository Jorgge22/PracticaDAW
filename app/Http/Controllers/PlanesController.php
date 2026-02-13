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

    public function create()
    {
        // Mostrar el formulario para crear un nuevo plan
        return view('planes.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'objetivo' => 'nullable|string|max:255',
            'activo' => 'boolean'
        ]);

        // Agregar el ID del ciclista autenticado
        $validated['id_ciclista'] = Auth::user()->id;

        // Insertar el nuevo plan
        DB::table('plan_entrenamiento')->insert($validated);

        return redirect()->route('planes')->with('success', 'Plan creado exitosamente');
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

        // Obtener las sesiones del plan
        $sesiones = DB::table('sesion_entrenamiento')
            ->where('id_plan', $id)
            ->get();

        return view('planes.show', ['plan' => $plan, 'sesiones' => $sesiones]);
    }

    public function edit($id)
    {
        // Obtener el plan a editar
        $idCiclista = Auth::user()->id;

        $plan = DB::table('plan_entrenamiento')
            ->where('id', $id)
            ->where('id_ciclista', $idCiclista)
            ->first();

        if (!$plan) {
            abort(404);
        }

        return view('planes.edit', ['plan' => $plan]);
    }

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'objetivo' => 'nullable|string|max:255',
            'activo' => 'boolean'
        ]);

        // Asegurarse de que el plan pertenece al usuario autenticado
        $idCiclista = Auth::user()->id;
        $plan = DB::table('plan_entrenamiento')
            ->where('id', $id)
            ->where('id_ciclista', $idCiclista)
            ->first();

        if (!$plan) {
            abort(404);
        }

        // Actualizar el plan
        DB::table('plan_entrenamiento')
            ->where('id', $id)
            ->update($validated);

        return redirect()->route('planes.show', $id)->with('success', 'Plan actualizado exitosamente');
    }

    public function destroy($id)
    {
        // Asegurarse de que el plan pertenece al usuario autenticado
        $idCiclista = Auth::user()->id;
        $plan = DB::table('plan_entrenamiento')
            ->where('id', $id)
            ->where('id_ciclista', $idCiclista)
            ->first();

        if (!$plan) {
            abort(404);
        }

        // Eliminar el plan
        DB::table('plan_entrenamiento')
            ->where('id', $id)
            ->delete();

        return redirect()->route('planes')->with('success', 'Plan eliminado exitosamente');
    }
}

