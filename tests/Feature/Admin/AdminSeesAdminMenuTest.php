<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AdminSeesAdminMenuTest extends TestCase
{
    use DatabaseMigrations;
    
    public function testPageSeesMenu()
    {
        $user = factory(User::class)->create(["admin" => '1']);

        $response = $this->actingAs($user)->get('/home');

        $response->assertStatus(200);
        $response->assertSee("All Invitations");
    }
}
