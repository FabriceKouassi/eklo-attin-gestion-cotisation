<?php

namespace Database\Seeders;

use App\Models\Antenne;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AntenneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Antenne::factory(10)->create();
    }
}
