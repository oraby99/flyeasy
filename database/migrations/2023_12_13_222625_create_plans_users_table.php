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
        Schema::create('plans_users', function (Blueprint $table) {
            $table->id();

            $table->foreignId('plan_id')->constrained('plans');
            $table->foreignId('user_id')->constrained('users');
            $table->date('end_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans_users');
    }
};
