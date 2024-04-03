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
        Schema::create('refsalariares', function (Blueprint $table) {
            $table->id();
            $table->string('version');
            $table->double('snmg');
            $table->double('salairereference');
            $table->enum("status", ["actif","inactif"])->default("actif");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refsalariares');
    }
};
