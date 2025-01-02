<?php

use App\Enums\UserGroup;
use App\Enums\LanguageEnum;
use App\Enums\ActivationStatus;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('work_id')->nullable();
            $table->string('company')->nullable();
            $table->unsignedTinyInteger('status')->default(ActivationStatus::ACTIVE);
            $table->unsignedTinyInteger('group')->default(UserGroup::USER);
            $table->string('profile_image')->nullable();
            $table->string('default_lang')->default(LanguageEnum::ENGLISH);
            $table->unsignedTinyInteger('discount')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->unsignedBigInteger('verification_code')->unique();
            $table->string('password');
            $table->string('country_code');
            $table->text('device_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
