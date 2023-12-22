<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListeCandidatureTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $listeCandidature= User::factory()->create();
        $this->actingAs($listeCandidature);
        $this->withoutMiddleware();
        $response = $this->get('/api/listeCandidature');

        $response->assertStatus(200);
    }
}
