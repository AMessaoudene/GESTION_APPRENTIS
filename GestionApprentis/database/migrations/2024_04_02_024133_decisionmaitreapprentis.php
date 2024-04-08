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
        Schema::create('decisionmaitreapprentis', function (Blueprint $table) {
            $table->id();
            $table->string('referencedma');
            $table->date('datedma');
            $table->unsignedBigInteger('pv_id');
            $table->foreign('pv_id')->references('id')->on('pv_installations')->onDelete('cascade');
            $table->unsignedBigInteger('parametre_id');
            $table->foreign('parametre_id')->references('id')->on('parametres')->onDelete('cascade');
            $table->unsignedBigInteger('bareme_id');
            $table->foreign('bareme_id')->references('id')->on('baremes')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('decisionmaitreapprentis');
    }
};
