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
        Schema::create('maitre_apprentis', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->enum('civilite', ['Homme', 'Femme']);
            $table->string('email')->unique();
            $table->string('telephonepro');
            $table->string('adresse');
            $table->string('fonction');
            $table->string('numapprentissupervises');
            $table->date('daterecrutement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maitre_apprentis');
    }
};
