<?php

use App\Http\Enums\Decisions;
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
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('demandeur_id')
                    ->comment('Id provenant de la table user')
                    ->constrained('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreignId('motif_id')
                    ->constrained()
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->text('description');
            $table->enum('decision', Decisions::all())->default(Decisions::EN_ATTENTE);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
