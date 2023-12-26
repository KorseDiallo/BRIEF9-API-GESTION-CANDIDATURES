<?php

namespace Tests\Feature;

use App\Models\Candidature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FormatListeCandidatureTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    
     public function testFormatListeCandidatures()
     {
         $admin = User::factory()->create(); 
         $this->actingAs($admin);
         $this->withoutMiddleware();
         $response = $this->get('/api/listeCandidature');
         $response->assertStatus(200); 
         $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                '*' => [
                    'id',
                    'user_id',
                    'formation_id',
                    'status',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);
     }
}
