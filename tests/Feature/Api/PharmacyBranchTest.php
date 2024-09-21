<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Pharmacy;
use App\Models\PharmacyBranch;

class PharmacyBranchTest extends TestCase
{
    use RefreshDatabase;


    public function test_pharmacy_branch_can_be_created()
    {
        $pharmacy = Pharmacy::factory()->create();

        $data = [
            'phone' => '123-456-7890',
            'address' => '123 Main Street',
            'commercial_registration_number' => 'CR123456',
            'tax_number' => 'TN123456',
            'is_open' => true,
            'lat' => 30.12345,
            'lng' => 31.67890,
            'pharmacy_id' => $pharmacy->id,
        ];

        $response = $this->postJson('/api/pharmacy-branches', $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'id',
                    'phone',
                    'address',
                    'commercial_registration_number',
                    'tax_number',
                    'is_open',
                    'lat',
                    'lng',
                    'pharmacy_id',
                    'created_at',
                    'updated_at',
                ],
            ]);

        $this->assertDatabaseHas('pharmacy_branches', [
            'phone' => '123-456-7890',
            'address' => '123 Main Street',
            'commercial_registration_number' => 'CR123456',
            'tax_number' => 'TN123456',
            'pharmacy_id' => $pharmacy->id,
        ]);
    }
}
