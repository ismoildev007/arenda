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
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('size')->nullable();
            $table->string('date')->nullable();
            $table->string('pinfl')->nullable()->unique();
            $table->string('inn')->nullable()->unique();
            $table->string('oked')->nullable();
            $table->string('bank')->nullable();
            $table->string('account')->nullable();
            $table->foreignId('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->foreignId('district_id')->constrained('districts', 'id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buildings');
    }
};
