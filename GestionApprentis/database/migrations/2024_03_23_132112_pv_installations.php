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
        Schema::create("pv_installations", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maitreapprenti_id');
            $table->foreign('maitreapprenti_id')->references('id')->on('maitre_apprentis');
            $table->unsignedBigInteger('contratapprenti_id');
            $table->foreign('contratapprenti_id')->references('id')->on('contrats_apprentis');
            $table->string("direction");
            $table->date("dateinstallationapprenti");
            $table->string("directionaffectation");
            $table->string("serviceaffectation");
            $table->timestamps();
        });
           

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("pv_installations");
    }
};
