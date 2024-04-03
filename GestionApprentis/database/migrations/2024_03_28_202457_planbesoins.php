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
        Schema::create('planbesoins', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->unsignedBigInteger('exercice_id');
            $table->foreign('exercice_id')->references('id')->on('exercices')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('structure_id');
            $table->foreign('structure_id')->references('id')->on('structures')->onDelete('cascade')->onUpdate('cascade');
            $table->date('date');
            $table->integer('nombreapprentis');
            $table->integer('nombereffectif');
            $table->integer('nombreapprentismax');
            $table->string('description')->nullable();
            $table->enum('status',['accepté','en cours','refusé'])->default('en cours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planbesoins');
    }
};
