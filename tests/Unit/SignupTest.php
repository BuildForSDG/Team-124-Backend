<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SignupTest extends TestCase
{
    use RefreshDatabase;
    
    public function testSignupAPIFailsIfNoPostDataIsNotSent()
    {
        $response = $this->json('POST', '/api/v1/signup',[]);
        
        $response->assertStatus(400);
    }
}
