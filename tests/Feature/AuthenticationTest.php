<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get(route('teachers.index'))->assertRedirect(route('login'));
    }

    public function test_user_can_sign_in_and_sign_out(): void
    {
        $user = User::factory()->create(['password' => 'Strong-Password-123']);

        $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'Strong-Password-123',
        ])->assertRedirect(route('teachers.index'));

        $this->post(route('logout'))->assertRedirect(route('login'));
    }
}
