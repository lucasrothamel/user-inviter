<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Invitations;
use Faker\Generator as Faker;

$factory->define(Invitations::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
        'user_created_id' => \App\Models\User::inRandomOrder()->first(),
        'method_id' => \App\Models\InvitationMethods::inRandomOrder()->first(),
        'user_inviting_id' => \App\Models\User::inRandomOrder()->first(),
        
    ];
});


$factory->state(Invitations::class, 'pending', [
    'user_created_id' => null
]);