<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\ActivationStatus;
use App\Enums\UserGroup;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'              => 'Admin',
            'email'             => 'admin@flyeasy.io',
            'phone'             => '123456',
            'password'          => '123456',
            'status'            => ActivationStatus::ACTIVE,
            'verification_code' => '111111',
            'email_verified_at' => now(),
            'group'             => UserGroup::ADMIN
        ]);
    }
}
