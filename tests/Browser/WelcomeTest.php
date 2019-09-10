<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class WelcomeTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testWelcome()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://user-inviter.loc/')
                    ->assertSee('We are here to provide you a great service!');
        });
    }
}
