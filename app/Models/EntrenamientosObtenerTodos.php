<?php

use App\Models\Entrenamiento;

header('Content-Type: application/json');

$filas = Entrenamiento::orderBy('fecha', 'desc')
    ->get(['id', 'id_ciclista', 'fecha', 'duracion', 'kilometros', 'recorrido'])
    ->toArray();

echo json_encode($filas);
