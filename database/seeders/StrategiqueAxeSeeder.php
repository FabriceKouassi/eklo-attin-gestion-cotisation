<?php

namespace Database\Seeders;

use App\Models\StrategiqueAxe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StrategiqueAxeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StrategiqueAxe::factory(6)->create();
    }
}
