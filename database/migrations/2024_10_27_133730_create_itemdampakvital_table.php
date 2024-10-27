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
        Schema::create('itemdampakvitals', function (Blueprint $table) {
            $table->id();
            $table->integer('urut');
            $table->text('tanya')->unique();
            $table->text('j1');
            $table->text('j2');
            $table->text('j3');
            $table->text('j4');
            $table->unsignedBigInteger('domain')->nullable();
            $table->foreign('domain')->references('id')->on('dampakvitals')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itemdampakvitals');
    }
};
