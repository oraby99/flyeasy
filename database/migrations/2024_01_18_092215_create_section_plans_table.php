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
        Schema::create('section_plans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('plan_id')->constrained('plans');
            $table->foreignId('section_library_id')->constrained('library_sections');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_plans');
    }
};
