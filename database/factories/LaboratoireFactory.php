<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Laboratoire>
 */
class LaboratoireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
    */
    public function definition(): array
    {
        return [
            'nom' => fake()->name(),
            'slug' => Str::slug($this->faker->sentence(5), '-'),
            'description' => fake()->text(),
        ];
    }
}
