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
        Schema::create('vaccin_disponibles', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->string('age');
            $table->string('title');
            $table->string('periode')->nullable();
            $table->integer('cout')->nullable();
            $table->string('frequence')->comment('Schema Vaccinal');
            $table->foreignId('vaccin_famille_id')
                    ->constrained()
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
        Schema::dropIfExists('vaccin_disponibles');
    }
};
