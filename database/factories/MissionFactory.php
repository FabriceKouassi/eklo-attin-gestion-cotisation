<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Directeur>
 */
class MissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'img' => $this->faker->name().'.png',
            'doc' => $this->faker->name().'.pdf',
            'content' => $this->faker->paragraph(40),
            'alt' => $this->faker->name(),
        ];
    }
}
