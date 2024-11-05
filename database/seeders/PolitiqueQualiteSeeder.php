<?php

namespace Database\Seeders;

use App\Models\PolitiqueQualite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PolitiqueQualiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PolitiqueQualite::factory()->create();
    }
}
