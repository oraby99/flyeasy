<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\YesOrNo;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('channels_members', function (Blueprint $table) {
            $table->id();

            $table->foreignId('channel_id')->constrained('channels');
            $table->unsignedTinyInteger('channel_level');
            $table->foreignId('member_id')->constrained('users');
            $table->unsignedTinyInteger('member_group');
            $table->unsignedTinyInteger('is_joined')->default(YesOrNo::NO);
            $table->foreignId('team_id')->nullable()->constrained('channels');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channels_members');
    }
};
