<?php

namespace App\Http\Controllers;

use App\Models\Ciclista;
use App\Models\PlanEntrenamiento;
use App\Models\SesionEntrenamiento;
use App\Models\BloqueEntrenamiento;
use App\Models\Bicicleta;
use Exception;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Validar que el usuario tiene sesión, si no, redirigir a login
        if (!session()->has('id_ciclista')) {
            return redirect('/login');
        }
        return view('menu');
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

    public function obtenerMenus(Request $request)
    {
        try {
        $idCiclista = session()->get('id_ciclista');
        
        if (!$idCiclista) {
            return response()->json(['error' => 'No autenticado'], 401);
        }

            $ciclista = Ciclista::find($idCiclista);

            if (!$ciclista) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ciclista no encontrado'
                ], 404);
            }

            // Obtener datos del usuario autenticado
            $planes = PlanEntrenamiento::where('id_ciclista', $idCiclista)
                ->select('id', 'nombre', 'objetivo', 'activo')
                ->get();

            // Obtener IDs de planes para filtrar sesiones
            $idPlanes = $planes->pluck('id')->toArray();
            
            $sesiones = SesionEntrenamiento::whereIn('id_plan', $idPlanes)
                ->select('id', 'nombre', 'fecha', 'completada')
                ->orderBy('fecha', 'desc')
                ->limit(10)
                ->get();

            $bloques = BloqueEntrenamiento::select('id', 'nombre', 'tipo')
                ->orderBy('nombre')
                ->get();

            $bicicletas = Bicicleta::select('id', 'nombre', 'tipo')->get();

            // Construir submenú de planes
            $submenusPlanes = [];
            foreach ($planes as $plan) {
                $submenusPlanes[] = [
                    'id' => $plan->id,
                    'nombre' => $plan->nombre,
                    'ruta' => 'plan.detalle',
                    'parametros' => ['id' => $plan->id],
                    'auxiliares' => ['objetivo' => $plan->objetivo]
                ];
            }

            // Construir submenú de sesiones
            $submenusSesiones = [];
            foreach ($sesiones as $sesion) {
                $submenusSesiones[] = [
                    'id' => $sesion->id,
                    'nombre' => $sesion->nombre ?? 'Sesión ' . $sesion->fecha,
                    'ruta' => 'sesion.detalle',
                    'parametros' => ['id' => $sesion->id],
                    'auxiliares' => ['fecha' => $sesion->fecha, 'completada' => $sesion->completada]
                ];
            }

            // Construir submenú de bloques
            $submenusBloques = [];
            foreach ($bloques as $bloque) {
                $submenusBloques[] = [
                    'id' => $bloque->id,
                    'nombre' => $bloque->nombre,
                    'ruta' => 'bloque.detalle',
                    'parametros' => ['id' => $bloque->id],
                    'auxiliares' => ['tipo' => $bloque->tipo]
                ];
            }

            // Construir submenú de bicicletas
            $submenusBicicletas = [];
            foreach ($bicicletas as $bicicleta) {
                $submenusBicicletas[] = [
                    'id' => $bicicleta->id,
                    'nombre' => $bicicleta->nombre,
                    'ruta' => 'bicicleta.detalle',
                    'parametros' => ['id' => $bicicleta->id],
                    'auxiliares' => ['tipo' => $bicicleta->tipo]
                ];
            }

            // Construir estructura de menús
            $menus = [
                [
                    'id' => 1,
                    'nombre' => 'Mis Planes',
                    'ruta' => 'planes',
                    'submenus' => $submenusPlanes
                ],
                [
                    'id' => 2,
                    'nombre' => 'Mis Sesiones',
                    'ruta' => 'sesiones',
                    'submenus' => $submenusSesiones
                ],
                [
                    'id' => 3,
                    'nombre' => 'Bloques',
                    'ruta' => 'bloques',
                    'submenus' => $submenusBloques
                ],
                [
                    'id' => 4,
                    'nombre' => 'Mis Bicicletas',
                    'ruta' => 'bicicletas',
                    'submenus' => $submenusBicicletas
                ],
                [
                    'id' => 5,
                    'nombre' => 'Resultados',
                    'ruta' => 'resultados',
                    'submenus' => [
                        [
                            'nombre' => 'Ver mis resultados',
                            'ruta' => 'resultados.listado'
                        ],
                        [
                            'nombre' => 'Registrar resultado',
                            'ruta' => 'resultado.crear'
                        ]
                    ]
                ],
                [
                    'id' => 6,
                    'nombre' => 'Perfil',
                    'ruta' => 'perfil',
                    'submenus' => [
                        [
                            'nombre' => 'Ver perfil',
                            'ruta' => 'perfil.ver'
                        ],
                        [
                            'nombre' => 'Editar perfil',
                            'ruta' => 'perfil.editar'
                        ]
                    ]
                ]
            ];

            return response()->json([
                'success' => true,
                'menus' => $menus,
                'usuario' => [
                    'id' => $ciclista->id,
                    'nombre' => $ciclista->nombre,
                    'apellidos' => $ciclista->apellidos,
                    'email' => $ciclista->email
                ]
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener menús: ' . $e->getMessage()
            ], 500);
        }
    }


    public function obtenerPlanes(Request $request)
    {
        try {
            $idCiclista = session()->get('id_ciclista');
            
            if (!$idCiclista) {
                return response()->json(['error' => 'No autenticado'], 401);
            }

            $planes = PlanEntrenamiento::where('id_ciclista', $idCiclista)
                ->with('sesiones')
                ->get();

            return response()->json([
                'success' => true,
                'planes' => $planes
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function obtenerSesiones(Request $request)
    {
        try {
            $idCiclista = session()->get('id_ciclista');
            
            if (!$idCiclista) {
                return response()->json(['error' => 'No autenticado'], 401);
            }

            // Obtener IDs de planes del usuario
            $idPlanes = PlanEntrenamiento::where('id_ciclista', $idCiclista)
                ->pluck('id')
                ->toArray();

            // Obtener sesiones de esos planes
            $sesiones = SesionEntrenamiento::whereIn('id_plan', $idPlanes)
                ->with(['plan', 'bloques'])
                ->orderBy('fecha', 'desc')
                ->paginate(10);

            return response()->json([
                'success' => true,
                'sesiones' => $sesiones
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
