<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create([
            'email' => 'hello@ahmedosama-st.com',
            'password' => 'secret123!@#',
        ]);

        $this->json('POST', 'api/admin/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_authenticate(): void
    {
        // Arrange
        $user = User::factory()->create([
            'email' => 'hello@ahmedosama-st.com',
            'password' => 'password',
        ]);

        // Act
        $response = $this->json('POST', 'api/admin/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        // Assert
        $response->assertJsonStructure([
            'meta' => [
                'token',
            ],
        ]);
    }

    public function test_users_can_logout(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $this->jsonAs($user, 'POST', 'api/admin/logout');

        // Assert
        $this->assertGuest();
    }
}
