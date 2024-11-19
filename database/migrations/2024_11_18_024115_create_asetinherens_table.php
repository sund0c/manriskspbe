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
        Schema::create('asetinherens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aset')->nullable();
            $table->unsignedBigInteger('inheren')->nullable();
            $table->integer('nilaidampak')->default(5);
            $table->integer('nilaikemungkinan')->default(5);    
            $table->foreign('aset')->references('id')->on('asets')->onDelete('restrict');
            $table->foreign('inheren')->references('id')->on('inherentrisikos')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asetinherens');
    }
};
