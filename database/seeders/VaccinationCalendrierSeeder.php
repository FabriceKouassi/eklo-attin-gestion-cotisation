<?php

namespace Database\Seeders;

use App\Models\VaccinationCalendrier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccinationCalendrierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VaccinationCalendrier::factory(10)->create();
    }
}
