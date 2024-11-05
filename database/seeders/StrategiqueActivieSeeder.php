<?php

namespace Database\Seeders;

use App\Models\StrategiqueActivite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StrategiqueActivieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StrategiqueActivite::factory(10)->create();
    }
}
