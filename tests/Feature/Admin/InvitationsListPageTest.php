<?php

namespace Tests\Feature\Admin;

use App\Models\InvitationMethods;
use App\Models\Invitations;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class InvitationsListPageTest extends TestCase
{
    use DatabaseMigrations;

    public function testInviteRedirectsToLogin()
    {
        $response = $this->get('/admin/invitations/list');
        $response->assertStatus(302);
        $response->assertRedirect("/login");
    }

    public function testInviteForNonAdminGivesForbidden()
    {
        $user = factory(User::class)->create(["admin" => 0]);
        $response = $this->actingAs($user)->get('/admin/invitations/list');
        $response->assertStatus(403);
    }

    public function testInviteOpens()
    {
        $user = factory(User::class)->create(["admin" => '1']);
        $user2 = factory(User::class)->create(["admin" => '0']);
        factory(InvitationMethods::class)->create();
        $invitation = factory(Invitations::class)->create(["user_inviting_id" => 2, 'user_created_id' => 1]);

        $response = $this->actingAs($user)->get('/admin/invitations/list');

        $response->assertStatus(200);
        $response->assertSee("All Invitations");
        
        $invitation = Invitations::whereId($invitation->id)->with('userInvited', 'userCreated')->first();

        $response->assertSee($invitation->userInvited->name);
        $response->assertSee($invitation->userCreated->name);
    }
}
