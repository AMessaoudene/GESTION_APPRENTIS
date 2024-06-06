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
            $table->unsignedBigInteger('planbesoins_id')->nullable();
            $table->foreign('planbesoins_id')->references('id')->on('planbesoins')->onDelete('cascade')->onUpdate('cascade');
            $table->string('referenceda');
            $table->date('dateda');
            $table->unsignedBigInteger('pv_id')->nullable();
            $table->foreign('pv_id')->references('id')->on('pv_installations')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('parametre_id')->nullable();
            $table->foreign('parametre_id')->references('id')->on('parametres')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('bareme_id')->nullable();
            $table->foreign('bareme_id')->references('id')->on('baremes')->onDelete('cascade')->onUpdate('cascade');
            $table->date('datetransfert')->nullable();
            $table->date('datedebutpresalaireS1');
            $table->date('datefinpresalaireS1');
            $table->date('datedebutpresalaireS2');
            $table->date('datefinpresalaireS2');
            $table->date('datedebutpresalaireS3')->nullable();
            $table->date('datefinpresalaireS3')->nullable();
            $table->date('datedebutpresalaireS4')->nullable();
            $table->date('datefinpresalaireS4')->nullable();
            $table->date('datedebutpresalaireS5')->nullable();
            $table->date('datefinpresalaireS5')->nullable();
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
