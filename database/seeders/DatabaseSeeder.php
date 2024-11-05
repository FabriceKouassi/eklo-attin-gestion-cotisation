<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Vaccination;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'nom' => 'AKO',
            'prenoms' => 'Fabrice',
            'email' => 'fabrice.ako@dkbsolutions.com',
            'password' => 'password',
            'phone' => '0788463692',
            'role' => 'admin'
        ]);

        User::factory()->create([
            'nom' => 'Egnin',
            'prenoms' => 'Aka',
            'email' => 'kouassi.ako4@gmail.com',
            'password' => 'password',
            'phone' => '0707070707',
            'role' => 'editor'
        ]);

        $this->call([
            VaccinFamilleSeeder::class,
            FlashInfoSeeder::class,
            ActualiteSeeder::class,
            DocteurConseilSeeder::class,
            DossierMoisSeeder::class,
            FaqSeeder::class,
            AntenneSeeder::class,
            LaboratoireSeeder::class,
            DirecteurSeeder::class,
            HistoriqueSeeder::class,
            OrganisationSeeder::class,
            PolitiqueQualiteSeeder::class,
            MissionSeeder::class,
            VaccinationCalendrierSeeder::class,
            TarificationSeeder::class,
            VaccinDisponibleSeeder::class,
            StrategiqueAxeSeeder::class,
            StrategiqueObjectifSeeder::class,
            StrategiqueActivieSeeder::class,
            DocumentSeeder::class,
            DocumentTypeSeeder::class,
            AgendaSeeder::class,
            BlogSeeder::class,
        ]);
    }
}
