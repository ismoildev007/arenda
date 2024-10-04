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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->constrained('buildings')->cascadeOnDelete();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('section_type')->nullable();
            $table->string('construction')->nullable();
            $table->integer('size')->nullable();
            $table->string('founded_date')->nullable();
            $table->string('safety')->nullable();
            $table->string('mode_of_operation')->nullable();
            $table->string('set')->nullable();
            $table->integer('floor')->nullable();
            $table->string('number_of_rooms')->nullable();
            $table->string('lift')->nullable();
            $table->string('parking')->nullable();
            $table->decimal('price_per_sqm', 8, 2);
            $table->text('images');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
