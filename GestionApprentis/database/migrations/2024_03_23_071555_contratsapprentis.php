<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('contrats_apprentis', function (Blueprint $table) {
            $table->id();
            $table->string('numcontrat')->unique();
            $table->unsignedBigInteger('apprenti_id')->nullable();
            $table->foreign('apprenti_id')->references('id')->on('apprentis');
            $table->date('datedebut');
            $table->date('datefin');
            $table->date('datetransfert')->nullable();
            $table->binary('pdf');
            $table->enum('statut',['validé','en cours', 'refusé'])->default('en cours');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('contrats_apprentis');
    }
};
