<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'role' => 'Admin', 
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Welcome@l1'),
            'location_latitude' => '37.7749', 
            'location_longitude' => '-122.4194',
            'date_of_birth' => '1980-01-01',
            'timezone' => 'UTC', 
        ]);
    }
}
