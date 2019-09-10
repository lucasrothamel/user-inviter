<?php

namespace Tests\Feature;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserSimpleProfilePageTest extends TestCase
{
    use DatabaseMigrations;

    public function testRedirectsToLogin()
    {
        $response = $this->get('/users/1');
        $response->assertStatus(302);
        $response->assertRedirect("/login");
    }

    public function testUsersListOpens()
    {
        $users = factory(User::class, 10)->create();

        $testUser = $users[2];
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get('/users/' . $testUser->id);

        $response->assertStatus(200);
        $response->assertSee($testUser->name);
        $response->assertSee($testUser->email);
        $response->assertSee('Successful');
        $response->assertSee('Pending');
    }

    public function testEmptyImages()
    {
        $users = factory(User::class, 5)->create();

        $testUser = $users[2];

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get('/users/' . $testUser->id);

        $response->assertSee('My Posts');
        $response->assertSee("No posts uploaded yet");
    }

    public function testImagesLoad()
    {
        $users = factory(User::class, 5)->create();

        $testUser = $users[2];
        $images = factory(Posts::class, 5)->state('image')->create(["user_id" => $testUser->id]);
        $texts = factory(Posts::class, 5)->state('text')->create(["user_id" => $testUser->id]);

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get('/users/' . $testUser->id);

        $response->assertSee('My Posts');

        foreach ($images as $image) {
            $response->assertSee($image->description);
            $response->assertSee($image->filename);
        }
        foreach ($texts as $text) {
            $response->assertSee($text->description);
        }
    }
}
