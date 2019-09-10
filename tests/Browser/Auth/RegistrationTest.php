<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegistrationTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * test that registration form works
     * @throws \Throwable
     */
    public function testRegistrationWorks()
    {
        $this->assertNotEquals("mysql", getenv('DB_CONNECTION'));
        $user = new User(
            [
                'name' => 'TestUser',
                'password' => 'secret123',
                'email' => 'test@example.com',
            ]
        );
        
        $this->browse(function (Browser $browser, $second) use ($user) {
            $browser->visit('http://user-inviter.loc/register')
                ->assertSee('Name')
                ->assertSee('E-Mail Address')
                ->assertSee('Password')
                ->assertSee('Confirm Password')
                ->type('name', $user["name"])
                ->type('email', $user["email"])
                ->type('password', $user["password"])
                ->type('password_confirmation', $user["password"])
                ->press('Register')
                ->assertSee('You are logged in!')
                ->assertPathIs('/home');
            
            $second->visit('http://user-inviter.loc/login')
                ->type('email', $user["email"])
                ->type('password', $user["password"])
                ->press("Login")
                ->assertSee('You are logged in!')
                ->assertPathIs('/home');
        });
    }
}
