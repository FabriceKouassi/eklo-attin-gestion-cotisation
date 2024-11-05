<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actualite>
 */
class ActualiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(5),
            'slug' => Str::slug($this->faker->sentence(5), '-'),
            'content' => $this->faker->paragraph(),
            'img'=> $this->faker->name(20).'.jpg',
            'img_alt'=> $this->faker->name(),
            'doc'=> $this->faker->name(20).'.pdf',
            'doc_alt'=> $this->faker->name(),
        ];
    }
}
