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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
            $table->integer('size');
            $table->decimal('price_per_sqm', 8, 2);
            $table->enum('status', ['noactive', 'active', 'bron']);
            $table->enum('type', ['business', 'standard']);
            $table->text('images'); // json field for storing multiple images
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
