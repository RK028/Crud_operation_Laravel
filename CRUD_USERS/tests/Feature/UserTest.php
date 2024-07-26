<?php

namespace Tests\Feature;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCreation()
{
    // Create an admin user for authentication
    $admin = User::factory()->create([
        'role' => 'Admin',
        'password' => bcrypt('password'),
    ]);

    // Generate a JWT token
    $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($admin);

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
                 'message' => 'User Create successfully.',
             ]);
}

}
