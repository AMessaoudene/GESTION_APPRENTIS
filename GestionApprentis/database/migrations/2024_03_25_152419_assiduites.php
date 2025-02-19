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
        Schema::create('assiduites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('apprenti_id')->nullable();
            $table->foreign('apprenti_id')->references('id')->on('apprentis')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('type',['absence','maladiecourte','maladie longue','arrettravail']);
            $table->date('datedebut');
            $table->date('datefin');
            $table->string('motif');
            $table->string('preuve');
            $table->enum('statut',['en cours','valide','refuse'])->default('en cours')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assiduites');
    }
};
