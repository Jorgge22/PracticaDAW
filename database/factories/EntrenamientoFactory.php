<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ciclista;
use App\Models\Bicicleta;
use App\Models\SesionEntrenamiento;

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
            'id_ciclista' => Ciclista::inRandomOrder()->first()->id ?? 1,
            'id_bicicleta' => Bicicleta::inRandomOrder()->first()->id ?? 1,
            'id_sesion' => null,
            'fecha' => $this->faker->dateTime(),
            'duracion' => sprintf('%02d:%02d:00', $this->faker->numberBetween(0, 3), $this->faker->numberBetween(0, 59)),
            'kilometros' => $this->faker->randomFloat(2, 10, 150),
            'recorrido' => $this->faker->city() . ' - ' . $this->faker->city(),
            'pulso_medio' => $this->faker->optional()->numberBetween(120, 160),
            'pulso_max' => $this->faker->optional()->numberBetween(160, 195),
            'potencia_media' => $this->faker->optional()->numberBetween(150, 280),
            'potencia_normalizada' => $this->faker->numberBetween(160, 300),
            'velocidad_media' => $this->faker->randomFloat(2, 20, 40),
            'puntos_estres_tss' => $this->faker->optional()->randomFloat(2, 50, 300),
            'factor_intensidad_if' => $this->faker->optional()->randomFloat(3, 0.6, 1.2),
            'ascenso_metros' => $this->faker->optional()->numberBetween(50, 1500),
            'comentario' => $this->faker->optional()->sentence(),
        ];
    }
}
