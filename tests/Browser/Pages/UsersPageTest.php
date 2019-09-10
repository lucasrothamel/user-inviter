<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UsersPageTest extends DuskTestCase
{
    use DatabaseMigrations;

    private $user;

    /**
     * test that you can click on the user page onto the result name of one user, and that the user detail page loads
     * @throws \Throwable
     */
    public function testUserPage()
    {
        $this->assertTrue(Hash::check('secret', $this->user->password));

        $user = $this->user;
        $this->browse(function (Browser $browser) use ($user) {
            $user2 = User::find(2);
            $user3 = User::find(3);
            $browser->loginAs($user)
                ->visit('http://user-inviter.loc/users')
                ->assertSee($user2->name)
                ->assertSee($user3->name)
                ->clickLink($user2->name)
                ->assertUrlIs("http://user-inviter.loc/users/" . $user2->id)
                ->assertSee($user2->name)
                ->assertDontSee($user3->name);
        });
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create([
            'email' => 'test@example.com',
        ]);
        factory(User::class, 10)->create();
        $this->assertDatabaseHas('users', ['email' => $this->user->email]);
    }
}
