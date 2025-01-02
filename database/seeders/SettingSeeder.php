<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::insert([
            [
                'key'           => 'free_teams_count',
                'value'         => '100',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'key'           => 'free_communities_count',
                'value'         => '100',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'key'           => 'free_sub_communities_count',
                'value'         => '100',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'key'           => 'free_members_count',
                'value'         => '100',
                'created_at'    => now(),
                'updated_at'    => now()
            ]
        ]);
    }
}
