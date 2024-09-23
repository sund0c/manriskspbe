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
        Schema::create('itemannexes', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->unsignedBigInteger('domain')->nullable();
            $table->timestamps();
            $table->foreign('domain')->references('id')->on('annexes')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itemannexes');
    }
};
