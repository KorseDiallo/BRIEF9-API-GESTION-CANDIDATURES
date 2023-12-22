<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CandidatTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testEmailUnique(): void
    {
        User::factory()->create(['email'=>'abdoulayediallo@gmail.com']);

        $data=['abdoulayediallo@gmail.com'];

        $candidat= User::factory()->make($data);
        $this->assertFalse($candidat->save());
        $this->assertNotNull($candidat->getError('email'));
    }

    public function testPrenomString(){
        $data = ['name'=> 123,];

        $candidat= User::factory()->make($data);
        $this->assertFalse($candidat->save());
        $this->assertNotNull($candidat->getError('name'));
    }

  
}
