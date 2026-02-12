<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ciclista;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HistoricoCiclista>
 */
class HistoricoCiclistaFactory extends Factory
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
            'fecha' => $this->faker->date(),
            'peso' => $this->faker->randomFloat(2, 60, 90),
            'ftp' => $this->faker->optional()->numberBetween(150, 350),
            'pulso_max' => $this->faker->optional()->numberBetween(170, 200),
            'pulso_reposo' => $this->faker->optional()->numberBetween(45, 70),
            'potencia_max' => $this->faker->optional()->numberBetween(600, 1200),
            'grasa_corporal' => $this->faker->optional()->randomFloat(2, 8, 25),
            'vo2max' => $this->faker->optional()->randomFloat(1, 35, 65),
            'comentario' => $this->faker->optional()->sentence(),
        ];
    }
}
