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
            'role' => 'Admin', // Assuming '1' represents Admin
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Welcome@l1'), // Default password
            'location_latitude' => '37.7749', // Example latitude
            'location_longitude' => '-122.4194', // Example longitude
            'date_of_birth' => '1980-01-01', // Example date of birth
            'timezone' => 'UTC', // Example timezone
        ]);
    }
}
