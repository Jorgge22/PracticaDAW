<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ciclista>
 */
class CiclistaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName() . ' ' . $this->faker->lastName(),
            'fecha_nacimiento' => $this->faker->date('Y-m-d', '-25 years'),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('12345678'), // Contraseña por defecto para pruebas encriptada
        ];
    }
}
