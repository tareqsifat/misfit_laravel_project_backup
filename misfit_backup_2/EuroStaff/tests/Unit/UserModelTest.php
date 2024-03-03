<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a user.
     *
     * @return void
     */
    public function testCreateUser()
    {
        // Create a user record
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => bcrypt('password123'), // Hashed password
        ]);

        // Assertions
        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
        ]);
    }

    /**
     * Test password hashing.
     *
     * @return void
     */
    public function testPasswordHashing()
    {
        $plainPassword = 'password123';

        // Create a user with a hashed password
        $user = User::create([
            'name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'password' => bcrypt($plainPassword), // Hashed password
        ]);

        // Check if the plain password matches the hashed password
        $this->assertTrue(Hash::check($plainPassword, $user->password));
    }
}
