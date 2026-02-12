<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Bicicleta;
use App\Models\TipoComponente;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ComponentesBicicleta>
 */
class ComponentesBicicletaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_bicicleta' => Bicicleta::inRandomOrder()->first()->id ?? 1,
            'id_tipo_componente' => TipoComponente::inRandomOrder()->first()->id ?? 1,
            'marca' => $this->faker->randomElement(['Shimano', 'SRAM', 'Campagnolo', 'FSA', 'Rotor']),
            'modelo' => $this->faker->optional()->word(),
            'especificacion' => $this->faker->optional()->bothify('??###'),
            'velocidad' => $this->faker->optional()->randomElement(['9v', '10v', '11v', '12v']),
            'posicion' => $this->faker->optional()->randomElement(['delantera', 'trasera', 'ambas']),
            'fecha_montaje' => $this->faker->date(),
            'fecha_retiro' => $this->faker->optional()->date(),
            'km_actuales' => $this->faker->randomFloat(2, 0, 5000),
            'km_max_recomendado' => $this->faker->optional()->randomFloat(2, 3000, 10000),
            'activo' => $this->faker->boolean(85),
            'comentario' => $this->faker->optional()->sentence(),
        ];
    }
}
