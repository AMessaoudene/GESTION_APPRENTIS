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
        Schema::create('exercices', function (Blueprint $table) {
            $table->id();
            $table->integer('annee');
            $table->date('datedebut');
            $table->date('datefin');
            $table->integer('nombreeffectif')->unsigned()->nullable();
            $table->integer('nombrebesoins')->unsigned();
            $table->float('massesalariaire');
            $table->float('budget');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercices');
    }
};
