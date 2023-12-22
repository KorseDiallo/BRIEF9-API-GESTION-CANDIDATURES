<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListeFormationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testListeFormation()
    {
        $admin= User::factory()->create();

        $this->actingAs($admin);

        $response = $this->get('/api/listeFormation');
        // var_dump($response);

        $response->assertStatus(200);
    }
}
