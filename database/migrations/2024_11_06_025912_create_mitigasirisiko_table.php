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
        Schema::create('mitigasirisikos', function (Blueprint $table) {
            $table->id();
            $table->text('mitigasi')->nullable();
            $table->text('poc')->nullable();
            $table->unsignedBigInteger('inherentrisiko')->nullable();
            $table->foreign('inherentrisiko')->references('id')->on('inherentrisikos')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitigasirisikos');
    }
};
