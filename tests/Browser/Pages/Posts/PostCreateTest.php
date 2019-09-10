<?php

namespace Tests\Browser;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Util;

class PostCreateTest extends DuskTestCase
{
    use DatabaseMigrations;

    private $user;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->user = new User(
            [
                'name' => 'TestUser',
                'password' => 'secret123',
                'email' => 'test@example.com',
            ]
        );

        $this->user->save();
    }

    /**
     * test that registration form works
     * @throws \Throwable
     */
    public function testOpens()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('http://user-inviter.loc/users/' . $this->user["id"])
                ->assertSee("User Profile: " . $this->user["name"])
                ->clickLink("Write a post!")
                ->assertUrlIs("http://user-inviter.loc/posts/new")
                ->assertDontSee(404)
                ->assertSee("Write a post!");
        });
    }

    public function testRequiresInput()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('http://user-inviter.loc/posts/new')
                ->assertSee("Write a post!")
                ->click("button[type=submit]")
                ->assertUrlIs('http://user-inviter.loc/posts/new')
                ->assertSee('The description field is required when image is not present.');
        });
    }

    public function testUploadMustBeImage()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('http://user-inviter.loc/posts/new')
                ->assertSee("Write a post!")
                ->attach('image', __DIR__ . '/../../../assets/sample.pdf')
                ->click("button[type=submit]")
                ->assertUrlIs('http://user-inviter.loc/posts/new')
                ->assertSee('The image must be an image.');
        });
    }

    public function testCreateImage()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('http://user-inviter.loc/posts/new')
                ->assertSee("Write a post!")
                ->type('description', "A great description!")
                ->attach('image', __DIR__ . '/../../../assets/image.jpg')
                ->click("button[type=submit]")
                ->assertUrlIs('http://user-inviter.loc/users/' . $this->user["id"])
                ->assertSee('A great description!')
                ->assertSee('image.jpg');

            $this->assertDatabaseHas('posts', [
                'description' => 'A great description!',
                'filename' => 'image.jpg',
                'type' => 'image',
                'user_id' => $this->user->id,
            ]);

            $post = Posts::orderBy('created_at', 'desc')->first();

            $url = $browser->visit('http://user-inviter.loc/users/' . $this->user["id"])
                ->element('#post-image-' . $post->id)
                ->getAttribute('src');

            $this->assertEquals($post->image_url, $url);
            $this->assertEquals(200, Util::getStatusCode($url));
        });
    }

    public function testCreateText()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('http://user-inviter.loc/posts/new')
                ->assertSee("Write a post!")
                ->type('description', "A great text message!")
                ->click("button[type=submit]")
                ->assertUrlIs('http://user-inviter.loc/users/' . $this->user["id"])
                ->assertSee('A great text message!');

            $this->assertDatabaseHas('posts', [
                'description' => 'A great text message!',
                'filename' => null,
                'type' => 'text',
                'user_id' => $this->user->id,
            ]);
        });
    }
}
