<?php

namespace Database\Seeders;

use App\Models\DossierMois;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DossierMoisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DossierMois::factory()->create();
    }
}
