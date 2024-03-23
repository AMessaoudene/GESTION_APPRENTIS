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
        Schema::create('evaluation_apprentis', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->unsignedBigInteger('apprenti_id');
            $table->foreign('apprenti_id')->references('id')->on('apprentis')->onDelete('cascade');
            $table->unsignedBigInteger('structureattache');
            $table->foreign('structureattache')->references('id')->on('structures')->onDelete('cascade');
            $table->date('datedebut');
            $table->date('datefin');
            $table->enum('comportementsociabilite',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationcs');
            $table->enum('communication',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationc');
            $table->enum('organisationhygiene',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationoh');
            $table->enum('ponctualiteassiduite',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationpa');
            $table->enum('respectreglementinterieur',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationrri');
            $table->enum('discipline',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationd');
            $table->enum('interettravail',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationit');
            $table->enum('motivation',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationm');
            $table->enum('espritinitiative',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationei');
            $table->enum('evolutionprocessusintegration',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationepi');
            $table->enum('qualificationsprofessionelles',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationqp');
            $table->enum('sensresponsabilite',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationsr');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_apprentis');
    }
};
