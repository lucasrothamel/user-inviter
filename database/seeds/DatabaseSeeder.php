<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(Posts::class);
        $this->call(InvitationMethodsSeeder::class);
        $this->call(InvitationsSeeder::class);
    }
}
