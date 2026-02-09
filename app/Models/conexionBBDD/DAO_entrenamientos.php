<?php
namespace App\Models\conexionBBDD;

use App\Models\PlanEntrenamiento;
use App\Models\SesionEntrenamiento;
use App\Models\BloqueEntrenamiento;
use App\Models\Bicicleta;

class DAO
{
    // Devuelve planes del ciclista como array simple
    public static function obtenerPlanesPorCiclista(int $idCiclista): array
    {
        $planes = PlanEntrenamiento::where('id_ciclista', $idCiclista)->get();
        $resultado = [];
        foreach ($planes as $p) {
            $resultado[] = [
                'id' => $p->id,
                'nombre' => $p->nombre,
                'objetivo' => $p->objetivo,
                'activo' => (bool)$p->activo,
            ];
        }
        return $resultado;
    }

    // Devuelve sesiones por array de ids de plan
    public static function obtenerSesionesPorPlanes(array $idPlanes): array
    {
        if (empty($idPlanes)) return [];
        $sesiones = SesionEntrenamiento::whereIn('id_plan', $idPlanes)
            ->orderBy('fecha', 'desc')
            ->get();
        $resultado = [];
        foreach ($sesiones as $s) {
            $resultado[] = [
                'id' => $s->id,
                'id_plan' => $s->id_plan,
                'nombre' => $s->nombre,
                'fecha' => (string)$s->fecha,
                'completada' => (bool)$s->completada,
            ];
        }
        return $resultado;
    }

    public static function obtenerBloques(): array
    {
        $bloques = BloqueEntrenamiento::orderBy('nombre')->get();
        $resultado = [];
        foreach ($bloques as $b) {
            $resultado[] = [
                'id' => $b->id,
                'nombre' => $b->nombre,
                'tipo' => $b->tipo,
            ];
        }
        return $resultado;
    }

    public static function obtenerBicicletas(): array
    {
        $bicis = Bicicleta::all();
        $resultado = [];
        foreach ($bicis as $bi) {
            $resultado[] = [
                'id' => $bi->id,
                'nombre' => $bi->nombre,
                'tipo' => $bi->tipo,
            ];
        }
        return $resultado;
    }
}