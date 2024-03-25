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
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('structure_id');
            $table->foreign('structure_id')->references('id')->on('structures');
            $table->string('nomresponsable')->nullable();
            $table->string('prenomresponsable')->nullable();
            $table->enum('civiliteresponsable',['Homme','Femme'])->nullable();
            $table->enum('role', ['DFP', 'DRH','SA','EvaluateurN+1']);
            $table->string('numerofixe')->nullable();
            $table->string('email');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
