<?php

namespace Tests\Unit;

use App\User;
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

    public function testSigninFailsIfPasswordIsNotCorrect()
    {
        $user = new User;
        $user->first_name = 'Test';
        $user->last_name = 'Test';
        $user->address = 'Test';
        $user->street_name = 'Test';
        $user->meter_no = '1';
        $user->email = 'test@test.com';
        $user->password = '$2y$10$TeS8nBRn3n5vVmDDIeH3ouFFkcv8bytepJTHKguiekZ4KuvuavxoC'; // 12345678
        $user->save();

        $input['email'] = 'test@test.com';
        $input['password'] = '1234567890';
        
        $response = $this->json('POST', '/api/v1/signin', $input);
        
        $response->assertStatus(401);

        $user->delete();
    }

    public function testSigninFailsIfEmailIsNotCorrect()
    {
        $user = new User;
        $user->first_name = 'Test';
        $user->last_name = 'Test';
        $user->address = 'Test';
        $user->street_name = 'Test';
        $user->meter_no = '1';
        $user->email = 'test@test.com';
        $user->password = '$2y$10$TeS8nBRn3n5vVmDDIeH3ouFFkcv8bytepJTHKguiekZ4KuvuavxoC'; // 12345678
        $user->save();

        $input['email'] = 'test123@test.com';
        $input['password'] = '12345678';
        
        $response = $this->json('POST', '/api/v1/signin', $input);
        
        $response->assertStatus(401);

        $user->delete();
    }

    public function testSigninPassesIfPOSTDataIsCorrect()
    {
        shell_exec('php artisan passport:install');

        $user = new User;
        $user->first_name = 'Test';
        $user->last_name = 'Test';
        $user->address = 'Test';
        $user->street_name = 'Test';
        $user->meter_no = '1';
        $user->email = 'test@test.com';
        $user->password = '$2y$10$TeS8nBRn3n5vVmDDIeH3ouFFkcv8bytepJTHKguiekZ4KuvuavxoC'; // 12345678
        $user->save();

        $input['email'] = 'test@test.com';
        $input['password'] = '12345678';
        
        $response = $this->json('POST', '/api/v1/signin', $input);
        
        $response->assertStatus(200);

        $user->delete();
    }
}
