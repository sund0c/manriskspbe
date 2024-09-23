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
        Schema::create('kriteriaannexes', function (Blueprint $table) {
            $table->id();
            $table->string('tanya')->unique();
            $table->string('penjelasan')->unique();
            $table->string('tujuan')->unique();
            $table->unsignedBigInteger('urut')->default(1);
            $table->unsignedBigInteger('item')->nullable();
            $table->foreign('item')->references('id')->on('kriteriaannexes')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteriaannexes');
    }
};
