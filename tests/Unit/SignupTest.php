<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SignupTest extends TestCase
{
    use RefreshDatabase;
    
    public function testSignupAPIFailsIfFirstNameIsNotSent()
    {
        $input = [
            'last_name' => 'Test',
            'address' => 'Test',
            'street_name' => 'Test',
            'meter_no' => '1',
            'email' => 'test@test.com',
            'password' => '12345678'
        ];

        $response = $this->json('POST', '/api/v1/signup', $input);
        
        $response->assertStatus(422);
    }
    
    public function testSignupAPIFailsIfLastNameIsNotSent()
    {
        $input = [
            'first_name' => 'Test',
            'address' => 'Test',
            'street_name' => 'Test',
            'meter_no' => '1',
            'email' => 'test@test.com',
            'password' => '12345678'
        ];

        $response = $this->json('POST', '/api/v1/signup', $input);
        
        $response->assertStatus(422);
    }
    
    public function testSignupAPIFailsIfAddressIsNotSent()
    {
        $input = [
            'first_name' => 'Test',
            'last_name' => 'Test',
            'street_name' => 'Test',
            'meter_no' => '1',
            'email' => 'test@test.com',
            'password' => '12345678'
        ];

        $response = $this->json('POST', '/api/v1/signup', $input);
        
        $response->assertStatus(422);
    }
    
    public function testSignupAPIFailsIfStreetNameIsNotSent()
    {
        $input = [
            'first_name' => 'Test',
            'last_name' => 'Test',
            'address' => 'Test',
            'meter_no' => '1',
            'email' => 'test@test.com',
            'password' => '12345678'
        ];

        $response = $this->json('POST', '/api/v1/signup', $input);
        
        $response->assertStatus(422);
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
        
        $response->assertStatus(422);
    }
    
    public function testSignupAPIFailsIfPasswordIsNotSent()
    {
        $input = [
            'first_name' => 'Test',
            'last_name' => 'Test',
            'address' => 'Test',
            'street_name' => 'Test',
            'meter_no' => '1',
            'email' => 'test@test.com',
        ];

        $response = $this->json('POST', '/api/v1/signup', $input);
        
        $response->assertStatus(422);
    }
    
    public function testSignupAPIFailsIfPasswordIsLessThanEightCharacters()
    {
        $input = [
            'first_name' => 'Test',
            'last_name' => 'Test',
            'address' => 'Test',
            'street_name' => 'Test',
            'meter_no' => '1',
            'email' => 'test@test.com',
            'password' => '123456',
        ];

        $response = $this->json('POST', '/api/v1/signup', $input);
        
        $response->assertStatus(422);
    }
    
    public function testSignupAPIFailsIfEmailIsNotSent()
    {
        $input = [
            'first_name' => 'Test',
            'last_name' => 'Test',
            'address' => 'Test',
            'street_name' => 'Test',
            'meter_no' => '1',
            'password' => '12345678',
        ];

        $response = $this->json('POST', '/api/v1/signup', $input);
        
        $response->assertStatus(422);
    }
    
    public function testSignupAPIFailsIfEmailAlreadyExist()
    {
        $input = [
            'first_name' => 'Test',
            'last_name' => 'Test',
            'address' => 'Test',
            'street_name' => 'Test',
            'meter_no' => '1',
            'password' => '12345678',
            'email' => 'test@test.com',
        ];
        
        $user = new User;
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->address = $input['address'];
        $user->street_name = $input['street_name'];
        $user->meter_no = $input['meter_no'];
        $user->email = $input['email'];
        $user->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm';
        $user->save();

        $response = $this->json('POST', '/api/v1/signup', $input);
        
        $response->assertStatus(422);
        $user->delete();
    }
    
    public function testSignupAPIPassesIfPOSTDataIsCorrect()
    {
        shell_exec('php artisan passport:install');
        $input = [
            'first_name' => 'Test',
            'last_name' => 'Test',
            'address' => 'Test',
            'street_name' => 'Test',
            'meter_no' => '1',
            'password' => '12345678',
            'email' => 'test@test.com',
        ];

        $response = $this->json('POST', '/api/v1/signup', $input);
        $response->assertStatus(200);
        
        User::find(json_decode($response->getContent())->id)->delete();
    }
}
