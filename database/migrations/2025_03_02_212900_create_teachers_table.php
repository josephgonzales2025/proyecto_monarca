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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('dni',8)->unique();
            $table->date('birthdate');
            $table->integer('age');
            $table->foreignId('local_id')->nullable()->constrained('locals')->onDelete('set null');
            $table->string('specialty', 100);
            $table->string('days', 255);
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
