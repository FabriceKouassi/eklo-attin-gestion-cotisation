<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocteurConseil>
 */
class DocteurConseilFactory extends Factory
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
            'fonction' => $this->faker->sentence(6),
            'content' => $this->faker->text(100),
            'alt' => $this->faker->sentence(6),
            'img' => $this->faker->image(),
        ];
    }
}
