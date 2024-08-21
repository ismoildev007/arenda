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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('password')->unique();
            $table->string('pinfl')->nullable();
            $table->string('birth_day')->nullable();
            $table->string('company_name')->nullable();
            $table->foreignId('region_id')->constrained('regions')->cascadeOnDelete();
            $table->foreignId('district_id')->constrained('districts')->cascadeOnDelete();
            $table->string('oked')->nullable();
            $table->string('bank')->nullable();
            $table->string('account')->nullable();
            $table->string('inn')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
