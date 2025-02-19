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
            $table->string('matricule');
            $table->string('nom');
            $table->string('prenom');
            $table->enum('civilite', ['Homme', 'Femme']);
            $table->string('email');
            $table->string('telephonepro');
            $table->string('adresse');
            $table->unsignedBigInteger('fonction')->nullable();
            $table->foreign('fonction')->references('id')->on('specialites')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('affectation')->nullable();
            $table->foreign('affectation')->references('id')->on('structures')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('diplome_id')->nullable();
            $table->foreign('diplome_id')->references('id')->on('diplomes')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('apprenti1_id')->unique()->nullable();
            $table->foreign('apprenti1_id')->references('id')->on('apprentis')->onDelete('cascade');
            $table->unsignedBigInteger('apprenti2_id')->unique()->nullable();
            $table->foreign('apprenti2_id')->references('id')->on('apprentis')->onDelete('cascade');
            $table->date('daterecrutement');
            $table->enum('statut', ['formé', 'non formé'])->default('formé');
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
