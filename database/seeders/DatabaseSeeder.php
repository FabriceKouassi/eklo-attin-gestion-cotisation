<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Fonction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Fonction::factory(5)->create();

        User::factory()->create([
            'nom' => 'AKO',
            'prenoms' => 'Fabrice',
            'fonction_id' => (int)1,
            'email' => 'fabrice.ako@dkbsolutions.com',
            'password' => 'password',
            'phone' => '0788463692',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'nom' => 'Egnin',
            'prenoms' => 'Aka',
            'fonction_id' => (int)4,
            'email' => 'kouassi.ako4@gmail.com',
            'password' => 'password',
            'phone' => '0707070707',
            'role' => 'gestionnaire',
        ]);

        $this->call([
            //
        ]);
    }
}
