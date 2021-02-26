<?php

namespace Tests\Feature\API;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function testCanLoginWithEmail()
    {
        $token = $this->postJson('/api/Login', [
            'email' => $this->user->email,
            'password' => 'password'
        ])
            ->assertSuccessful()
            ->json('token');

        $this
            ->getJson('/api/User', ['Authorization' => 'Bearer ' . $token])
            ->assertSuccessful();
    }

    public function testCanLoginWithUsername()
    {
        User::factory()->create(['email' => 'john@example.com']);

        $token = $this->postJson('/api/Login', [
            'username' => $this->user->username,
            'password' => 'password'
        ])
            ->assertSuccessful()
            ->json('token');

        $this
            ->getJson('/api/User', ['Authorization' => 'Bearer ' . $token])
            ->assertSuccessful();
    }
}
