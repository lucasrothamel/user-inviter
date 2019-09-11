<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\InvitationMethods;
use App\Models\Invitations;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Invitations::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
        'user_created_id' => User::inRandomOrder()->first(),
        'method_id' => InvitationMethods::inRandomOrder()->first(),
        'user_inviting_id' => User::inRandomOrder()->first(),
        
    ];
});


$factory->state(Invitations::class, 'pending', [
    'user_created_id' => null
]);
