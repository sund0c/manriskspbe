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
        Schema::create('kategorises', function (Blueprint $table) {
            $table->id();
            $table->integer('urut');
            $table->text('tanya')->unique();
            $table->string('j1');
            $table->string('j2');
            $table->string('j3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategorises');
    }
};
