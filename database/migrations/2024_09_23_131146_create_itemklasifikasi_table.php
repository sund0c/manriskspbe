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
        Schema::create('itemklasifikasis', function (Blueprint $table) {
            $table->id();
            $table->integer('urut');
            $table->string('tanya')->unique();
            $table->string('j1');
            $table->string('j2');
            $table->string('j3');
            $table->string('j4');
            $table->unsignedBigInteger('domain')->nullable();
            $table->foreign('domain')->references('id')->on('klasifikasis')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itemklasifikasis');
    }
};
