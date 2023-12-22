<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListeCandidatTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $candidat= User::factory()->create();

        $this->actingAs($candidat);
        $this->withoutMiddleware();

        $response = $this->get('/api/listeCandidat');
        var_dump($response);
        $response->assertStatus(200);
    }
}
