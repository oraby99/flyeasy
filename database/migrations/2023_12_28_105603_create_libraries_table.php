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
        Schema::create('libraries', function (Blueprint $table) {
            $table->id();

            $table->string('full_file_path');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_extension');
            $table->string('file_size');
            $table->unsignedTinyInteger('file_type');
            $table->foreignId('section_id')->constrained('library_sections');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libraries');
    }
};
