<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bicicleta>
 */
class BicicletaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->randomElement(['Specialized', 'Trek', 'Cannondale', 'Giant', 'Scott', 'Orbea', 'BH', 'Merida']) . ' ' . $this->faker->word(),
            'tipo' => $this->faker->randomElement(['carretera', 'mtb', 'gravel', 'rodillo']),
            'comentario' => $this->faker->optional()->sentence(),
        ];
    }
}
