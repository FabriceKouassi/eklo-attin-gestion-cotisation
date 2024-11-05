<?php

namespace Database\Seeders;

use App\Models\VaccinDisponible;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccinDisponibleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VaccinDisponible::factory(5)->create();
    }
}
