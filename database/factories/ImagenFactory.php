<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Imagen>
 */
class ImagenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombfile' => 'hola',
            'extension' => 'hoa',
            'ruta' => 'ruta',
            'publicacion_id' => $this->faker->randomElement([1,2,3]),
            'created_at' => $this->faker->dateTimeBetween(now()),
            'updated_at' => $this->faker->dateTimeBetween("+1 year",now()),
        ];
    }
}
