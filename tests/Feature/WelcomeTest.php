<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeTest extends TestCase
{
    public function testWelcome()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSeeText("User Inviter");
    }

    public function testLoginLinkShown() {
        $response = $this->get("/");

        $response->assertStatus(200);
        $response->assertSeeText("Login");
        $response->assertSeeText("Register");
    }
}
