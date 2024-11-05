<?php

namespace Database\Seeders;

use App\Models\FlashInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlashInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // FlashInfo::factory(20)->create(['content' => fake()->text()]);
        FlashInfo::factory(5)->create();
    }
}
