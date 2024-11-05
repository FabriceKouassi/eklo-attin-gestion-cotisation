<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VaccinDisponible>
 */
class VaccinDisponibleFactory extends Factory
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
            'age' => $this->faker->paragraph(1),
            'title' => $this->faker->paragraph(1),
            'periode' => $this->faker->paragraph(1),
            'cout' => $this->faker->numberBetween(1000, 10000),
            'frequence' => $this->faker->paragraph(1),
            'vaccin_famille_id' => $this->faker->randomElement([1,2]),
        ];
    }
}
