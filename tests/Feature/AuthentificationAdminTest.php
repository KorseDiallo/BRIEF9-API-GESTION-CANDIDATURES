<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthentificationAdminTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    
     public function testAuthentificationAdmin(): void
     {
         $admin = User::factory()->create([
             'role' => 'Admin',
             'password' => bcrypt('admin123'),
         ]);
 
         $loginData = [
             'email' => $admin->email,
             'password' => 'admin123',
         ];
 
         $response = $this->postJson('/api/login', $loginData);
 
         $response->assertStatus(200)
             ->assertJson([
                 'status' => 1,
                 'message' => 'Vous êtes connecté en tant qu\'administrateur',
                 'role' => 'Admin',
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
