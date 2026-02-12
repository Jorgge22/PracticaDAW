<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TipoComponente>
 */
class TipoComponenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->randomElement([
                'Cuadro',
                'Horquilla',
                'Ruedas',
                'Transmisión',
                'Frenos',
                'Manillar',
                'Tija',
                'Sillín',
                'Pedales',
                'Dirección',
                'Bielas',
                'Cassette',
                'Cadena',
                'Cambio',
                'Platos'
            ]),
            'descripcion' => $this->faker->sentence(),
        ];
    }
}
