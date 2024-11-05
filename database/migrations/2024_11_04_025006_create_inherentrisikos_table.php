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
        Schema::create('inherentrisikos', function (Blueprint $table) {
            $table->id();
            $table->string('kritikal')->nullable();
            $table->text('kerawanan')->nullable();
            // $table->text('kerawanan')->nullable()->unique();
            $table->text('ancaman')->nullable();
            $table->text('aspekrisiko')->nullable();
            $table->text('uraiandampak')->nullable();
            $table->enum('jenis', ['APLIKASI', 'INFRASTRUKTUR', 'SDM', 'DATA/INFORMASI'])->default('APLIKASI');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inherentrisikos');
    }
};
