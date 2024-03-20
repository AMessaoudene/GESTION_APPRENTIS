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
            $table->string("direction");
            $table->date("dateinstallationapprenti");
            $table->string("directionaffection");
            $table->string("serviceaffectation");
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
