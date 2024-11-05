<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
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
            'description' => $this->faker->sentence(),
            // 'img'=> $this->faker->name(20).'.jpg',
            'img_alt'=> $this->faker->name(),
            // 'doc'=> $this->faker->name(20).'.pdf',
            'doc_alt'=> $this->faker->name(),
        ];
    }
}
