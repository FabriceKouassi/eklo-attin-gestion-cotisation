<?php

namespace Database\Seeders;

use App\Models\VaccinFamille;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccinFamilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VaccinFamille::factory(2)->create();
    }
}
