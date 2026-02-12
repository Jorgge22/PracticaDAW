<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PlanEntrenamiento;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SesionEntrenamiento>
 */
class SesionEntrenamientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_plan' => PlanEntrenamiento::inRandomOrder()->first()->id ?? 1,
            'fecha' => $this->faker->date(),
            'nombre' => $this->faker->words(3, true),
            'descripcion' => $this->faker->sentence(),
            'completada' => $this->faker->boolean(40),
        ];
    }
}
