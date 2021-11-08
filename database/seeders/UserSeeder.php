<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // General Test
        \App\Models\User::factory(1)->admin()->create();
        \App\Models\User::factory(1)->carrier()->create();
        \App\Models\User::factory(1)->advertiser()->create();
        \App\Models\User::factory(1)->multirole()->create();

        // Mail Test
        \App\Models\User::factory(1)->mailtest()->create();
        \App\Models\User::factory(1)->mailtest()->create();

        // System Test
        \App\Models\User::factory(1)->superadmin()->create();
    }
}
