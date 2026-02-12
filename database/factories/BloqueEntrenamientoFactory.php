<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BloqueEntrenamiento>
 */
class BloqueEntrenamientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->words(2, true),
            'descripcion' => $this->faker->optional()->sentence(),
            'tipo' => $this->faker->randomElement(['rodaje', 'intervalos', 'fuerza', 'recuperacion', 'test']),
            'duracion_estimada' => sprintf('%02d:%02d:00', $this->faker->numberBetween(0, 2), $this->faker->numberBetween(0, 59)),
            'potencia_pct_min' => $this->faker->optional()->randomFloat(2, 40, 75),
            'potencia_pct_max' => $this->faker->optional()->randomFloat(2, 76, 130),
            'pulso_pct_max' => $this->faker->optional()->randomFloat(2, 65, 95),
            'pulso_reserva_pct' => $this->faker->optional()->randomFloat(2, 55, 90),
            'comentario' => $this->faker->optional()->sentence(),
        ];
    }
}
