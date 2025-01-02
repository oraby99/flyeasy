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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users');
            $table->unsignedBigInteger('added_teams_count')->default(0);
            $table->unsignedBigInteger('remains_teams_count');
            $table->unsignedBigInteger('added_communities_count')->default(0);
            $table->unsignedBigInteger('remains_communities_count');
            $table->unsignedBigInteger('added_sub_communities_count')->default(0);
            $table->unsignedBigInteger('remains_sub_communities_count');
            $table->unsignedBigInteger('added_members_count')->default(0);
            $table->unsignedBigInteger('remains_members_count');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
