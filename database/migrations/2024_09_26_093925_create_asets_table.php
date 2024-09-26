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
        Schema::create('asets', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('url')->nullable();
            $table->string('ip')->nullable();
            $table->string('keterangan')->nullable();
            $table->enum('klasifikasi', ['RAHASIA', 'TERBATAS', 'INTERNAL', 'PUBLIK'])->default('RAHASIA');
            $table->enum('kategorise', ['STRATEGIS', 'TINGGI', 'RENDAH'])->default('STRATEGIS');
            $table->enum('risiko', ['CRITICAL', 'HIGH', 'MEDIUM','LOW'])->default('CRITICAL');
            $table->enum('jenis', ['APLIKASI', 'INFRASTRUKTUR', 'SDM', 'DATA/INFORMASI'])->default('APLIKASI');
            $table->unsignedBigInteger('user')->nullable();
            $table->foreign('user')->references('id')->on('users')->onDelete('restrict');
            $table->timestamps();
            $table->unique(['nama','jenis', 'ip', 'url'], 'kunciunik');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asets');
    }
};
