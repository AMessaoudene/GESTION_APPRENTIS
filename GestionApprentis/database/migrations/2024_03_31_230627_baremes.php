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
        Schema::create('baremes', function (Blueprint $table) {
            $table->id();
            $table->string('version')->unique();
            $table->unsignedBigInteger('diplome_id');
            $table->foreign('diplome_id')->references('id')->on('diplomes');
            $table->unsignedBigInteger('refsalariaire_id');
            $table->foreign('refsalariaire_id')->references('id')->on('refsalaraires');
            $table->enum('statut', ['actif', 'inactif'])->default('actif');
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
