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
    
    public function testSignupAPIFailsIfFirstNameIsNotSent()
    {
        $input = [
            'last_name' => 'Test',
            'address' => 'Test',
            'street_name' => 'Test',
            'meter_No' => 1,
            'email' => 'test@test.com',
            'password' => '12345678'
        ];

        $response = $this->json('POST', '/api/v1/signup', $input);
        
        $response->assertStatus(400);
    }
    
    public function testSignupAPIFailsIfLastNameIsNotSent()
    {
        $input = [
            'first_name' => 'Test',
            'address' => 'Test',
            'street_name' => 'Test',
            'meter_No' => 1,
            'email' => 'test@test.com',
            'password' => '12345678'
        ];

        $response = $this->json('POST', '/api/v1/signup', $input);
        
        $response->assertStatus(400);
    }
    
    public function testSignupAPIFailsIfAddressIsNotSent()
    {
        $input = [
            'first_name' => 'Test',
            'last_name' => 'Test',
            'street_name' => 'Test',
            'meter_No' => 1,
            'email' => 'test@test.com',
            'password' => '12345678'
        ];

        $response = $this->json('POST', '/api/v1/signup', $input);
        
        $response->assertStatus(400);
    }
    
    public function testSignupAPIFailsIfStreetNameIsNotSent()
    {
        $input = [
            'first_name' => 'Test',
            'last_name' => 'Test',
            'address' => 'Test',
            'meter_No' => 1,
            'email' => 'test@test.com',
            'password' => '12345678'
        ];

        $response = $this->json('POST', '/api/v1/signup', $input);
        
        $response->assertStatus(400);
    }
    
    public function testSignupAPIFailsIfMeterNoIsNotSent()
    {
        $input = [
            'first_name' => 'Test',
            'last_name' => 'Test',
            'address' => 'Test',
            'street_name' => 'Test',
            'email' => 'test@test.com',
            'password' => '12345678'
        ];

        $response = $this->json('POST', '/api/v1/signup', $input);
        
        $response->assertStatus(400);
    }
    
    public function testSignupAPIFailsIfPasswordIsNotSent()
    {
        $input = [
            'first_name' => 'Test',
            'last_name' => 'Test',
            'address' => 'Test',
            'street_name' => 'Test',
            'meter_No' => 1,
            'email' => 'test@test.com',
        ];

        $response = $this->json('POST', '/api/v1/signup', $input);
        
        $response->assertStatus(400);
    }
}
