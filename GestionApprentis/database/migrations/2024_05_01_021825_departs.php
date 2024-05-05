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
        Schema::create('departs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('apprenti_id');
            $table->foreign('apprenti_id')->references('id')->on('apprentis')->onDelete('cascade')->onUpdate('cascade');
            $table->date('datedepart');
            $table->enum('motif', ['résiliation','transfert']);
            $table->string('refcourrier');
            $table->date('datecourrier');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departs');
    }
};
