<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    private $user;

    /**
     * test that login form works
     * @throws \Throwable
     */
    public function testLoginWorks()
    {
        $this->assertTrue(Hash::check('secret', $this->user->password));

        $user = $this->user;
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('http://user-inviter.loc/login')
                ->assertSee('E-Mail Address')
                ->assertSee('Password')
                ->type('email', $user->email)
                ->type('password', 'secret')
                ->press('Login')
                ->assertSee('You are logged in!')
                ->assertPathIs('/home');
        });
    }

    /**
     * test error message appears when providing wrong password
     * @throws \Throwable
     */
    public function testWrongPassword()
    {
        $user = $this->user;

        $this->createBrowsersFor(function (browser $browser) use ($user) {
            $browser->visit('http://user-inviter.loc/login')
                ->assertSee('E-Mail Address')
                ->assertSee('Password')
                ->type('email', $user->email)
                ->type('password', 'something else')
                ->press('Login')
                ->assertSee("These credentials do not match our records.")
                ->assertPathIs('/login');
        });
    }

    /**
     * test error message appears when providing wrong password
     * @throws \Throwable
     */
    public function testWrongUser()
    {
        $this->setUp();

        $user = $this->user;
        $this->createBrowsersFor(function (browser $browser) use ($user) {
            $browser->visit('http://user-inviter.loc/login')
                ->assertSee('E-Mail Address')
                ->assertSee('Password')
                ->type('email', 'some-user@something.net')
                ->type('password', 'something else')
                ->press('Login')
                ->assertSee("These credentials do not match our records.")
                ->assertPathIs('/login');
        });
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create([
            'email' => 'test@example.com',
        ]);
        $this->assertDatabaseHas('users', ['email' => $this->user->email]);
    }
}
