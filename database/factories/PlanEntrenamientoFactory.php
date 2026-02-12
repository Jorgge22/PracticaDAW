<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ciclista;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlanEntrenamiento>
 */
class PlanEntrenamientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_ciclista' => Ciclista::inRandomOrder()->first()->id ?? 1,
            'nombre' => $this->faker->words(3, true),
            'descripcion' => $this->faker->sentence(),
            'fecha_inicio' => $this->faker->date(),
            'fecha_fin' => $this->faker->date(),
            'objetivo' => $this->faker->randomElement(['Preparación maratón', 'Mejora FTP', 'Pérdida peso', 'Resistencia', 'Velocidad', 'Fondo']),
            'activo' => $this->faker->boolean(70),
        ];
    }
}
