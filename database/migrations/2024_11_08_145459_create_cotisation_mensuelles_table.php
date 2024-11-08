<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cotisation_mensuelles', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')
                    ->constrained()
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->tinyInteger('mois'); // Mois de la cotisation (1-12)
            $table->year('annee'); // Année de la cotisation
            $table->date('date_paiement')->nullable(); // Date du paiement (peut être null si non payé)
            $table->enum('status', ['non payé', 'payé']);

            $table->foreignId('gestionnaire_id')
                    ->constrained('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
                    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotisation_mensuelles');
    }
};
