<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PharmacyTest extends TestCase
{
    use RefreshDatabase;

    public function test_pharmacy_can_be_created()
    {
        // Arrange: Prepare a user and data for the pharmacy
        $user = User::factory()->create();
        $data = [
            'name' => 'Test Pharmacy',
            'hotline' => '123-456-7890',
            'image' => 'pharmacy.jpg',
            'is_active' => true,
            'user_id' => $user->id,
        ];

        // Act: Make the request to create the pharmacy
        $response = $this->postJson('/api/store-pharmacy', $data);

        // Assert: Check response and database
        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'id',
                    'name',
                    'hotline',
                    'image',
                    'is_active',
                    'user_id',
                    'created_at',
                    'updated_at',
                ],
            ]);

        $this->assertDatabaseHas('pharmacies', [
            'name' => 'Test Pharmacy',
            'hotline' => '123-456-7890',
            'user_id' => $user->id,
        ]);
    }

    public function test_pharmacy_creation_requires_name()
    {
        // Arrange: Prepare a user
        $user = User::factory()->create();

        // Act: Attempt to create a pharmacy without a name
        $response = $this->postJson('/api/store-pharmacy', [
            'hotline' => '123-456-7890',
            'image' => UploadedFile::fake()->image('pharmacy.jpg'),
            'is_active' => true,
            'user_id' => $user->id,
        ]);

        // Assert: Check for validation error
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name']);
    }

    public function test_pharmacy_creation_requires_hotline()
    {
        // Arrange: Prepare a user
        $user = User::factory()->create();

        // Act: Attempt to create a pharmacy without a hotline
        $response = $this->postJson('/api/store-pharmacy', [
            'name' => 'Test Pharmacy',
            'image' => UploadedFile::fake()->image('pharmacy.jpg'),
            'is_active' => true,
            'user_id' => $user->id,
        ]);

        // Assert: Check for validation error
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['hotline']);
    }

    public function test_pharmacy_creation_requires_user_id()
    {
        // Act: Attempt to create a pharmacy without a user_id
        $response = $this->postJson('/api/store-pharmacy', [
            'name' => 'Test Pharmacy',
            'hotline' => '123-456-7890',
            'image' => UploadedFile::fake()->image('pharmacy.jpg'),
            'is_active' => true,
        ]);

        // Assert: Check for validation error
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['user_id']);
    }

    public function test_pharmacy_creation_requires_valid_user_id()
    {
        // Arrange: Prepare invalid user ID
        $response = $this->postJson('/api/store-pharmacy', [
            'name' => 'Test Pharmacy',
            'hotline' => '123-456-7890',
            'image' => UploadedFile::fake()->image('pharmacy.jpg'),
            'is_active' => true,
            'user_id' => 9999, // Assuming this user ID does not exist
        ]);

        // Assert: Check for validation error
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['user_id']);
    }
}
