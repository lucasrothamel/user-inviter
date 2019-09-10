<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Invitations;

class InvitationsSeeder extends Seeder
{
    /**
     * Create both successful and pending invitations
     * @return void
     */
    public function run()
    {
        foreach (User::all() as $user) {
            factory(Invitations::class, mt_rand(2, 10))
                ->create(["user_inviting_id" => $user->id]);

            factory(Invitations::class, 10)->state('pending')
                ->create(["user_inviting_id" => $user->id]);
        }
    }
}
