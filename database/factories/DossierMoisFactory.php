<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DossierMois>
 */
class DossierMoisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'content' => $this->faker->text(),
            'img_alt' => $this->faker->sentence(),
            'img' => $this->faker->image(),
            'doc_alt' => $this->faker->sentence(),
            'doc' => $this->faker->sentence(),
        ];
    }
}
