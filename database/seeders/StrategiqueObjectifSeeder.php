<?php

namespace Database\Seeders;

use App\Models\StrategiqueObjectif;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StrategiqueObjectifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StrategiqueObjectif::factory(6)->create();
    }
}
