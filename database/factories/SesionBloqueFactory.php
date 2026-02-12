<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SesionEntrenamiento;
use App\Models\BloqueEntrenamiento;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SesionBloque>
 */
class SesionBloqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_sesion_entrenamiento' => SesionEntrenamiento::inRandomOrder()->first()->id ?? 1,
            'id_bloque_entrenamiento' => BloqueEntrenamiento::inRandomOrder()->first()->id ?? 1,
            'orden' => $this->faker->numberBetween(1, 5),
            'repeticiones' => $this->faker->numberBetween(1, 3),
        ];
    }
}
