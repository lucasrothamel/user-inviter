<?php

namespace Tests\Browser;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MyProfilePageTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * test that registration form works
     * @throws \Throwable
     */
    public function testOwnProfileOpens()
    {
        $this->assertNotEquals("mysql", getenv('DB_CONNECTION'));
        $user = new User(
            [
                'name' => 'TestUser',
                'password' => 'secret123',
                'email' => 'test@example.com',
            ]
        );
        
        $user->save();
        
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('http://user-inviter.loc/home')
                ->clickLink("My Profile")
                ->assertSee("User Profile: " . $user["name"])
                ->assertUrlIs('http://user-inviter.loc/users/' . $user["id"]);
        });
    }
}
