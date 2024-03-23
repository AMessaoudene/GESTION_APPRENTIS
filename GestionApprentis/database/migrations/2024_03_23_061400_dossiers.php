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
        Schema::create("dossiers", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('apprentis_id');
            $table->foreign('apprentis_id')->references('id')->on('apprentis')->onDelete('cascade');
            $table->binary('contratapprenti');
            $table->binary('decisionapprenti');
            $table->binary('decisionmaitreapprenti');
            $table->binary('pvinstallation');
            $table->binary('copiecheque');
            $table->binary('extraitnaissance');
            $table->binary('autorisationparentele')->nullable();
            $table->binary('photo')->nullable();
            $table->enum("status", ["valide","en cours","refuse"])->default("en cours");
            $table->string("motif");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("dossiers");
    }
};
