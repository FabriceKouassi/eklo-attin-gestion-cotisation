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
        Schema::create('prestation_types', function (Blueprint $table) {
            $table->id();
            $table->string('libelle')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('img')->nullable();
            $table->integer('isNav')->enum([0, 1])->default(0); //0: Masquer  dans le menu / 1: Afficher dans le menu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestation_types');
    }
};
