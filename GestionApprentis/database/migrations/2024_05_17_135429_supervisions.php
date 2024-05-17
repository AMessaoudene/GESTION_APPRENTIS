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
        Schema::create('supervisions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('apprenti_id');
            $table->foreign('apprenti_id')->references('id')->on('apprentis');
            $table->unsignedBigInteger('maitreapprenti_id');
            $table->foreign('maitreapprenti_id')->references('id')->on('maitre_apprentis');
            $table->enum('status',['actif','inactif'])->default('actif');
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
