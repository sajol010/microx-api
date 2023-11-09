<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{

    protected $bearerToken = '';
    public function test_register(){
        $user  = $this->postJson('/api/user', [
            'name' => fake()->name,
            'username' => fake()->userName,
            'email' => fake()->email,
            'password' => 'password'
        ]);

        $success = $user->json('success');
        $user->assertSuccessful();
        $this->assertTrue($success);

    }

    public function test_duplicate_email(){
        $user  = $this->postJson('/api/user', [
            'name' => 'sajol',
            'username' => 'sajolmahud010',
            'email' => 'admin@admin.com',
            'password' => 'password'
        ]);
        $response = $user->json();
        $this->assertTrue($response['success'] == false);
    }
    /**
     * A basic feature test login.
     */
    public function test_login(): void
    {
        // creating the user
        $this->postJson('/api/user', [
            'name' => fake()->name,
            'username' => 'sajolmahmud010',
            'email' => 'admin@admin.com',
            'password' => 'password'
        ]);

        $user = $this->postJson('/api/user/login', [
            'email' => 'admin@admin.com',
            'password' => 'password'
        ]);
        $user->assertSuccessful();

        // setup global config for
        $token = $user->json()['data']['token'];
        putenv("BEARER_TOKEN=$token");
    }


}
