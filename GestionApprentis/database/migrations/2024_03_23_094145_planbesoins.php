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
            $table->unsignedBigInteger('structure_id');
            $table->foreign('structure_id')->references('id')->on('structures')->onDelete('cascade')->onUpdate('cascade');
            $table->date('date');
            $table->integer('nombreapprentis');
            $table->integer('nombereffectif');
            $table->integer('nombreapprentismax');
            $table->string('description')->nullable();
            $table->enum('statut',['accepté','en cours','refusé'])->default('en cours');
            $table->timestamps();
        });

        /* Create a many-to-many relationship between the projects and tasks tables
        Schema::create('project_planbesoin', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('planbesoin_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('planbesoin_id')->references('id')->on('planbesoins')->onDelete('cascade');
            $table->primary(['project_id', 'planbesoin_id']);
        });*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
