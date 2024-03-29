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
        Schema::create('apprentis', function (Blueprint $table) {
            $table->id();
            $table->string('numcontrat');
            $table->date('datecontrat');
            $table->date('datedebut');
            $table->date('datefin');
            $table->string('nom');
            $table->string('prenom');
            $table->enum('civilite', ['Homme', 'Femme']); // Example of enum column
            $table->enum('nationalite',['algerienne','etrangere']);
            $table->date('datenaissance');
            $table->string('adresse');
            $table->string('email')->unique();
            $table->string('telephone');
            $table->enum('niveauscolaire', ['primaire', 'moyen', 'secondaire']); // Example of enum column
            $table->enum('specialite',['secretariat','marketing','grh','comptabilite','exploitationinformatique','basededonnéesinformatique','documentationetarchives','sécuritéreseaux','operateurmicroinformatique','agentdesaisie','maintenancematerielsinformatique','gestiondestock','electromecanique','electricitéauto','plomberie','developpeurweb','cuisine','electricitéindustrielle','telecommunications','assurance','magasinier']);
            $table->unsignedBigInteger('structure_id')->nullable();
            $table->foreign('structure_id')->references('id')->on('structures')->onDelete('cascade');
            $table->unsignedBigInteger('diplome1_id')->nullable();
            $table->foreign('diplome1_id')->references('id')->on('diplomes')->onDelete('cascade');
            $table->unsignedBigInteger('diplome2_id')->nullable();
            $table->foreign('diplome2_id')->references('id')->on('diplomes')->onDelete('cascade');
            $table->enum('status', ['actif', 'inactif'])->default('actif'); // Example of enum column with default value
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apprentis');
    }
};
