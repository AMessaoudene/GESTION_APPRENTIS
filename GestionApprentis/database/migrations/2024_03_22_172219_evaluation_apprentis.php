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
            $table->foreign('apprenti_id')->references('id')->on('apprentis')->onDelete('cascade')->onUpdate('cascade');
            $table->date('datedebut');
            $table->date('datefin');
            $table->enum('comportementsociabilite',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationcs')->nullable();
            $table->enum('communication',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationc')->nullable();
            $table->enum('organisationhygiene',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationoh')->nullable();
            $table->enum('ponctualiteassiduite',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationpa')->nullable();
            $table->enum('respectreglementinterieur',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationrri')->nullable();
            $table->enum('discipline',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationd')->nullable();
            $table->enum('interettravail',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationit')->nullable();
            $table->enum('motivation',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationm')->nullable();
            $table->enum('espritinitiative',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationei')->nullable();
            $table->enum('evolutionprocessusintegration',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationepi')->nullable();
            $table->enum('qualificationsprofessionelles',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationqp')->nullable();
            $table->enum('sensresponsabilite',['Très bon', 'Bon', 'Moyen', 'Faible']);
            $table->string('observationsr')->nullable();
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
