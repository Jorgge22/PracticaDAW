<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entrenamiento>
 */
class EntrenamientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha' => now(),
            'duracion' => '01:00:00',
            'kilometros' => 20.00,
            'recorrido' => 'Ruta de prueba',
            'comentario' => null,
            'id_bicicleta' => 1,
            'id_sesion' => null,
            'potencia_normalizada' => 200,
            'velocidad_media' => 25.00
        ];
    }
}
