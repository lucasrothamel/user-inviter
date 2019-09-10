<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class InvitePageTest extends TestCase
{
    use DatabaseMigrations;

    public function testInviteRedirectsToLogin()
    {
        $response = $this->get('/invite');
        $response->assertStatus(302);
        $response->assertRedirect("/login");
    }

    public function testInviteOpens()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get('/invite');

        $response->assertStatus(200);
        $response->assertSee("Invite a new user!");
        $response->assertSee("Add all your friends, family, co-workers, anybody you know!");

        $response->assertSee("Twitter");
        $response->assertSee("Facebook");
        $response->assertSee("Google Mail");
        $response->assertSee("Linked In");
    }

    public function testInviteSends()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->post('/invite', [
                'invites' => 'test@test.com',
            ]);

        $response->assertStatus(200);

        $response->assertSee("Invite a new user!");
        $response->assertSee("Great, you invited some users, but surely, you want to invite some more users...");
        $response->assertSee("Add all your friends, family, co-workers, anybody you know!");
    }
}
