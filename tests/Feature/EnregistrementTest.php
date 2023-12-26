<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnregistrementTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function testEnregistrement(): void
    // {
    //     User::factory()->create();
    //     $response= $this->post('/api/register');
    //     $response->assertStatus(200);
    // }


    public function testEnregistrement(): void
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'telephone' => '123456789',
            'password' => 'password123',
            'role' => 'Candidat',
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Candidat créer avec Succès',
            ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'telephone' => '123456789',
            'role' => 'Candidat',
        ]);
    }
}

  

