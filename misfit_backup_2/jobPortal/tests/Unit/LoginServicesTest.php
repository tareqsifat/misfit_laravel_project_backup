<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Services\LoginServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginServicesTest extends TestCase
{
    use RefreshDatabase; // Use this trait to reset the database after each test.

    /** @test */
    public function it_can_login_a_user()
    {
        // Create a user for testing purposes.
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Instantiate the LoginServices class.
        $loginService = new LoginServices();

        // Attempt to login the user.
        $loggedInUser = $loginService->login('test@example.com', 'password123');

        // Assert that the user was logged in.
        $this->assertInstanceOf(User::class, $loggedInUser);
        $this->assertTrue(Auth::check());
    }

    /** @test */
    public function it_returns_false_for_invalid_credentials()
    {
        // Instantiate the LoginServices class.
        $loginService = new LoginServices();

        // Attempt to login with invalid credentials.
        $loggedInUser = $loginService->login('invalid@example.com', 'invalid_password');

        // Assert that the login attempt failed and returned false.
        $this->assertFalse($loggedInUser);
        $this->assertFalse(Auth::check());
    }
}
