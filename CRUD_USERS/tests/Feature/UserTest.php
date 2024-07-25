<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    

    use RefreshDatabase; // Ensure the database is reset for each test

    public function testUserCreation()
    {
        $admin = User::factory()->create([
            'role' => 'Admin',
            'password' => bcrypt('password'),
        ]);
    
        // Generate a token (if using Passport)
        $token = $admin->createToken('Test Token')->plainTextToken;
    
        // Make the API request with the token
        $response = $this->postJson('/api/users', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'role' => 'Admin',
            'email' => 'john.doe@example.com',
            'password' => 'password',
            'location_latitude' => '40.7128',
            'location_longitude' => '-74.0060',
            'date_of_birth' => '1990-01-01',
            'timezone' => 'UTC',
        ], [
            'Authorization' => 'Bearer ' . $token
        ]);
    
        $response->assertStatus(201)
                 ->assertJson([
                     'success' => true,
                     'message' => 'User created successfully.'
                 ]);
    }

}
