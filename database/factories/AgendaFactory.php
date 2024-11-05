<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agenda>
 */
class AgendaFactory extends Factory
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
            // 'img'=> $this->faker->name(20).'.jpg',
            // 'doc'=> $this->faker->name(20).'.pdf',
            'location'=> $this->faker->address(),
            'eventDate'=> $this->faker->date(),
            'eventHour'=> $this->faker->time(),
        ];
    }
}
