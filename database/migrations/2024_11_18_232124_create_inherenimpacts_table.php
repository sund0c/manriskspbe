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
        Schema::create('inherenimpacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inheren')->nullable();
            $table->unsignedBigInteger('impact')->nullable();
            $table->integer('nilaiimpact')->default(5);    
            $table->foreign('impact')->references('id')->on('inherenimpacts')->onDelete('restrict');
            $table->foreign('inheren')->references('id')->on('asetinherens')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inherenimpacts');
    }
};
