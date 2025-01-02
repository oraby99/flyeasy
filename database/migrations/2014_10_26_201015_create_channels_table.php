<?php

use App\Enums\YesOrNo;
use App\Enums\ChannelLevel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained('users');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedTinyInteger('level')->default(ChannelLevel::TEAM);
            $table->string('logo')->nullable();
            $table->integer('notify_counter')->default(0);
            $table->unsignedTinyInteger('is_deleted')->default(YesOrNo::NO);
            $table->unsignedTinyInteger('is_archived')->default(YesOrNo::NO);
            $table->unsignedBigInteger('copied_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channels');
    }
};
