<?php

namespace Tests\Feature;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MyProfilePageTest extends TestCase
{
    use DatabaseMigrations;

    public function testProfilePageImagesAndTexts()
    {
        $testUser = factory(User::class, 1)->create()[0];

        $images = factory(Posts::class, 2)->state('image')->create(["user_id" => $testUser->id]);
        $texts = factory(Posts::class, 2)->state('text')->create(["user_id" => $testUser->id]);

        $response = $this->actingAs($testUser)
            ->get('/users/' . $testUser->id);

        foreach ($images as $image) {
            $response->assertSee($image->description);
            $response->assertSee($image->filename);
        }
        foreach ($texts as $text) {
            $response->assertSee($text->description);
        }
    }

    public function testProfilePageUploadButtonShowsForUser()
    {
        $testUser = factory(User::class, 1)->create()[0];

        $response = $this->actingAs($testUser)
            ->get('/users/' . $testUser->id);

        $response->assertSee("Write a post!");
    }

    public function testProfilePageUploadButtonHiddenForOthers()
    {
        $users = factory(User::class, 5)->create();
        $testUser = $users[0];
        $otherUser = $users[1];

        $response = $this->actingAs($testUser)
            ->get('/users/' . $otherUser);

        $response->assertDontSee("Write a post!");
    }
}

