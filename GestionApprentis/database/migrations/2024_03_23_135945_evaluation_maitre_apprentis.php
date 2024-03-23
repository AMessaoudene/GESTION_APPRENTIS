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
        Schema::create('evaluation_maitre_apprentis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maitreapprenti_id');
            $table->foreign('maitreapprenti_id')->references('id')->on('maitre_apprentis')->onDelete('cascade')->onUpdate('cascade');
            $table->string('reference');
            $table->string('structureattache');
            $table->date('datedebut');
            $table->date('datefin');
            $table->enum('sensresponsabilite',[['Très bon', 'Bon', 'Moyen', 'Faible']]);
            $table->string('observationsr');
            $table->enum('disponibiliteorientationapprenti',[['Très bon', 'Bon', 'Moyen', 'Faible']]);
            $table->string('observationdoa');
            $table->enum('respectmissionencadrement',[['Très bon', 'Bon', 'Moyen', 'Faible']]);
            $table->string('observationrme');
            $table->enum('effetpoursuiviapprenti',[['Très bon', 'Bon', 'Moyen', 'Faible']]);
            $table->string('observationepsa');
            $table->enum('qualiteencadrementapprenti',[['Très bon', 'Bon', 'Moyen', 'Faible']]);
            $table->string('observationqea');
            $table->string('avisapprenti');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_maitre_apprentis');
    }
};
