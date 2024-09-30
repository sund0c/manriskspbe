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
        Schema::create('asetkategoris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aset')->nullable();
            $table->unsignedBigInteger('tanya')->nullable();
            $table->integer('jawab');
            $table->string('keterangan')->nullable();
            $table->foreign('aset')->references('id')->on('asets')->onDelete('restrict');
            $table->foreign('tanya')->references('id')->on('kategorises')->onDelete('restrict');
            $table->timestamps();
        });
    }
    // 10s/d15	Rendah
    // 16s/d34	Tinggi
    // 35s/d50	Strategis


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asetkategoris');
    }
};
