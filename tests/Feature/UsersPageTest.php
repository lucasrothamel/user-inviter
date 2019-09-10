<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UsersPageTest extends TestCase
{
    use DatabaseMigrations;

    public function testRedirectsToLogin()
    {
        $response = $this->get('/users');
        $response->assertStatus(302);
        $response->assertRedirect("/login");
    }

    public function testUsersListOpens()
    {
        $users = factory(User::class, 10)->create();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get('/users');

        $response->assertStatus(200);
        $response->assertSee("Find a user!");
        $response->assertSee("Find your friends, and make new friends!");

        foreach ($users as $user) {
            $response->assertSee(htmlentities($user->name));
        }
    }

    public function testUsersListFiltersByFirstUser()
    {
        $users = factory(User::class, 10)->create();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get('/users?name=' . $user->name);

        $response->assertStatus(200);
        $response->assertSee("Find a user!");
        $response->assertSee("Find your friends, and make new friends!");

        foreach ($users as $user) {
            $response->assertDontSee(htmlentities($user->name));
        }
    }

    public function testUsersListFiltersByEmail()
    {
        $users = factory(User::class, 10)->create();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get('/users?email=' . $user->email);

        $response->assertStatus(200);
        $response->assertSee("Find a user!");
        $response->assertSee("Find your friends, and make new friends!");

        foreach ($users as $user) {
            $response->assertDontSee(htmlentities($user->name));
        }
    }
}
