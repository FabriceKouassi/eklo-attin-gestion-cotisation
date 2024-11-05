<?php

namespace Database\Seeders;

use App\Models\DocteurConseil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocteurConseilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DocteurConseil::factory(1)->create();
    }
}
