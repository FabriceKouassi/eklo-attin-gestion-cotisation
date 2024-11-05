<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Directeur>
 */
class DirecteurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->name(),
            'img' => $this->faker->name().'.png',
            'doc' => $this->faker->name().'.pdf',
            'content' => $this->faker->paragraph(40),
            'alt' => $this->faker->name(),
        ];
    }
}
