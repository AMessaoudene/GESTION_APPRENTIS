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
            $table->unsignedBigInteger('refsalariaires_id')->nullable();
            $table->foreign('refsalariaires_id')->references('id')->on('refsalariaires');
            $table->unsignedBigInteger('diplome_id');
            $table->foreign('diplome_id')->references('id')->on('diplomes');
            $table->integer('tauxs1_apprentis');
            $table->double('montantchiffres1_apprentis');
            $table->string('montantlettres1_apprentis');
            $table->integer('tauxs1_maitreapprentis');
            $table->double('montantchiffres1_maitreapprentis');
            $table->string('montantlettres1_maitreapprentis');
            $table->integer('tauxs2_apprentis');
            $table->double('montantchiffres2_apprentis');
            $table->string('montantlettres2_apprentis');
            $table->integer('tauxs2_maitreapprentis');
            $table->double('montantchiffres2_maitreapprentis');
            $table->string('montantlettres2_maitreapprentis');
            $table->integer('tauxs3_apprentis')->nullable();
            $table->double('montantchiffres3_apprentis')->nullable();
            $table->string('montantlettres3_apprentis')->nullable();
            $table->integer('tauxs3_maitreapprentis')->nullable();
            $table->double('montantchiffres3_maitreapprentis')->nullable();
            $table->string('montantlettres3_maitreapprentis')->nullable();
            $table->integer('tauxs4_apprentis')->nullable();
            $table->double('montantchiffres4_apprentis')->nullable();
            $table->string('montantlettres4_apprentis')->nullable();
            $table->integer('tauxs4_maitreapprentis')->nullable();
            $table->double('montantchiffres4_maitreapprentis')->nullable();
            $table->string('montantlettres4_maitreapprentis')->nullable();
            $table->integer('tauxs5_apprentis')->nullable();
            $table->double('montantchiffres5_apprentis')->nullable();
            $table->string('montantlettres5_apprentis')->nullable();
            $table->integer('tauxs5_maitreapprentis')->nullable();
            $table->double('montantchiffres5_maitreapprentis')->nullable();
            $table->string('montantlettres5_maitreapprentis')->nullable();
            $table->enum('statut', ['actif', 'inactif'])->default('actif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baremes');
    }
};
