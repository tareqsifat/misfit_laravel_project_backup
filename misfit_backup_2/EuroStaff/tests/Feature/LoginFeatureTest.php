<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class LoginFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_login_with_valid_credentials()
    {
        $password = 'password123'; // Change this to your desired password
        $user = User::factory()->create([
            'password' => Hash::make($password),
        ]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect(route('welcome'));
        $this->assertEquals('login successful', Session::get('message')); // Change this to match your success message
        $this->assertEquals(true, Auth::check($user));
    }

    /** @test */
    public function user_cannot_login_with_invalid_credentials()
    {
        $response = $this->post(route('login'), [
            'email' => 'invalid@example.com',
            'password' => 'invalid_password',
        ]);


        // $this->assertEquals(true, );
        $response->assertSessionHas('message', 'login failed! credentials does not match'); // Change this to match your error message
        $response->assertStatus(302); // Check if it's a redirect response
        $this->assertStringContainsString('/auth/login', $response->headers->get('Location'));
    }
    
    public function testShowLoginForm()
    {
        $response = $this->get('/auth/login');
        $response->assertStatus(200);
    }

}
