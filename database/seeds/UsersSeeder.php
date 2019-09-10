<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Demo User',
            'email' => 'demo@test.com',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            "admin" => "1",
        ]);
        factory(App\Models\User::class, 10)->create();
    }
}
