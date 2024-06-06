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
        Schema::create('structures', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->string('adressecourriel');
            $table->string('referencedecisionresponsable')->nullable();
            $table->string('decisionresponsable')->nullable();
            $table->date('datedecisionresponsable')->nullable();
            $table->string('nomresponsable')->nullable();
            $table->string('prenomresponsable')->nullable();
            $table->string('civiliteresponsable')->nullable();
            $table->string('fonctionresponsable')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('structures');
    }
};
