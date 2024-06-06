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
            $table->unsignedBigInteger('apprentis_id')->nullable();
            $table->foreign('apprentis_id')->references('id')->on('apprentis')->onDelete('cascade');
            $table->string('contratapprenti');
            $table->string('decisionapprenti')->nullable();
            $table->string('decisionmaitreapprenti')->nullable();
            $table->string('pvinstallation')->nullable();
            $table->string('copiecheque');
            $table->string('extraitnaissance');
            $table->string('autorisationparentele')->nullable();
            $table->string('photo')->nullable();
            $table->string('pieceidentite')->nullable();
            $table->enum("status", ["valide","en cours","refuse"])->default("en cours");
            $table->string("motif")->nullable();
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
