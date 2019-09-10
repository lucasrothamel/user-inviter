<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\InvitationMethods;
use Faker\Generator as Faker;

$factory->define(InvitationMethods::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'created_at' => now(),
    ];
});
