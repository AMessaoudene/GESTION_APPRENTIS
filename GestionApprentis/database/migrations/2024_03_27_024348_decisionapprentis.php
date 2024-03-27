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
        Schema::create('decisionapprentis', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->date('date');
            $table->unsignedBigInteger('pv_id');
            $table->foreign('pv_id')->references('id')->on('pv_installations')->onDelete('cascade');
            $table->unsignedBigInteger('parametre_id');
            $table->foreign('parametre_id')->references('id')->on('parametres')->onDelete('cascade');
            $table->date('datetransfert')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('decisionapprentis');
    }
};
