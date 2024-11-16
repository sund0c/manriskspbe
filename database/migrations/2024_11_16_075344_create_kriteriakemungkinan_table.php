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
        Schema::create('kriteriakemungkinans', function (Blueprint $table) {
            $table->id();
            $table->text('rare')->nullable();
            $table->text('unlikely')->nullable();
            $table->text('possible')->nullable();
            $table->text('likely')->nullable();
            $table->text('almost')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteriakemungkinans');
    }
};
