<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BicicletasController extends Controller
{
    public function __construct()
    {
        // Solo los usuarios autenticados pueden acceder a las bicicletas
        $this->middleware('auth');
    }

    public function index()
    {
        // Obtener todas las bicicletas de la base de datos
        $bicicletas = DB::table('bicicleta')->get();
        return view('bicicletas.index', ['bicicletas' => $bicicletas]);
    }

    public function create()
    {
        return view('bicicletas.create');
    }

    public function store(Request $request)
    {
        // Validar los datos que se van a introducir
        $validar = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:carretera,mtb,gravel,rodillo',
            'comentario' => 'string|max:255'
        ]);

        // Insertar los nuevos valores
        DB::table('bicicleta')->insert($validar);

        return redirect()->route('bicicletas');
    }

    public function show($id)
    {
        $bici = DB::table('bicicleta')->where('id', $id)->first();

        if (! $bici) {
            abort(404);
        }

        return view('bicicletas.edit', ['bicicleta' => $bici]);
    }

    public function edit($id)
    {
        $bici = DB::table('bicicleta')
            ->where('id', $id) 
            ->first();

        if (! $bici) {
            abort(404);
        }

        return view('bicicletas.edit', ['bicicleta' => $bici]);
    }

    public function update(Request $request, $id)
    {
        $validar = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:carretera,mtb,gravel,rodillo',
            'comentario' => 'string|max:255'
        ]);

        $bici = DB::table('bicicleta')
            ->where('id', $id) 
            ->first();

        if (! $bici) {
            abort(404);
        }

        DB::table('bicicleta')
            ->where('id', $id)
            ->update($validar);

        return redirect()->route('bicicletas', $id);
    }

    public function destroy($id)
    {
        // Buscar la bicicleta por el id recibido
        $bici = DB::table('bicicleta')->where('id', $id)->first();

        if (! $bici) {
            abort(404);
        }

        // Eliminar la bicicleta
        DB::table('bicicleta')->where('id', $id)->delete();

        // Redirigir a la lista de bicicletas
        return redirect()->route('bicicletas');
    }
}
