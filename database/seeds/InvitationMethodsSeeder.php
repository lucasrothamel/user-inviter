<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvitationMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invitation_methods')->insert([
            'name' => 'email',
            'created_at' => \Carbon\Carbon::now(),
        ]);
    }
}
