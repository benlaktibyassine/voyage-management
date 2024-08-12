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
        Schema::create('voyages', function (Blueprint $table) {
            $table->id('mat');
            $table->binary('codeqr');
            $table->date('date');
            $table->string('scan_sortie');
            $table->string('scan_entree');
            $table->date('scan_date');
            $table->date('scanE_date');
            $table->unsignedBigInteger('chauffeur_id');
            $table->foreign('chauffeur_id')->references('id')->on('chauffeurs')->onDelete('cascade');
            $table->foreign('camion_id')->references('id')->on('camions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voyages');
    }
};
