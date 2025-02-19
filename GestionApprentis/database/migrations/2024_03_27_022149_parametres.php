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
        Schema::create("parametres", function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('typedecisiondg');
            $table->date('datedecisiondg');
            $table->string('nomprenomdg');
            $table->enum('civilitedg',['monsieur','madame']);
            $table->enum('civilitedrh',['monsieur','madame']);
            $table->enum('civilitedfc',['monsieur','madame']);
            $table->enum('status',['actif','inactif']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
