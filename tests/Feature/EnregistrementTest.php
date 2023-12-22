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
    public function testEnregistrement(): void
    {
        User::factory()->create();
        $response= $this->post('/api/register');
        $response->assertStatus(200);
    }

  
}
