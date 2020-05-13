<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SigninTest extends TestCase
{
    use RefreshDatabase;

    public function testSigninFailsIfPOSTDataIsNotSent()
    {
        $response = $this->json('POST', '/api/v1/signup', []);
        
        $response->assertStatus(422);
    }
}
