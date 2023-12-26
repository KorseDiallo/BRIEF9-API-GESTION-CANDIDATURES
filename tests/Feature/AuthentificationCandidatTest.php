<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthentificationCandidatTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function testAuthentificationCandidat(): void
    {
        $candidat = User::factory()->create([
            'role' => 'Candidat',
            'password' => bcrypt('password123'),
        ]);

        $loginData = [
            'email' => $candidat->email,
            'password' => 'password123',
        ];

        $response = $this->postJson('/api/login', $loginData);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 1,
                'message' => 'Vous êtes connecté en tant que candidat',
                'role' => 'Candidat',
            ])
            ->assertJsonStructure([
                'token',
                'datas' => [
                    'id',
                    'name',
                    'email',
                    'telephone', 
                ],
            ]);
    }
}
