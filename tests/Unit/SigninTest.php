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
        $response = $this->json('POST', '/api/v1/signin', []);
        
        $response->assertStatus(401);
    }

    public function testSigninFailsIfEmailIsNotSent()
    {
        $input['password'] = '12345678';

        $response = $this->json('POST', '/api/v1/signin', $input);
        
        $response->assertStatus(401);
    }

    public function testSigninFailsIfPasswordIsNotSent()
    {
        $input['email'] = 'test@test.com';
        
        $response = $this->json('POST', '/api/v1/signin', $input);
        
        $response->assertStatus(401);
    }
}
