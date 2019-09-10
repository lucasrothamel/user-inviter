<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\User;

class HomePageTest extends TestCase
{
    use DatabaseMigrations;
    
    public function testHomeRedirectsToLogin()
    {
        $response = $this->get('/home');
        $response->assertStatus(302);
        $response->assertRedirect("/login");
    }

    public function testHome()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get('/home');

        $response->assertStatus(200);
        $response->assertSee("You are logged in");
        $response->assertSee("My recent successful invitations");
        $response->assertSee("My pending invitations");
        $response->assertSee("You have no");
    }
}
