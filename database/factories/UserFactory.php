<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProfileTemplates;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => str_replace("'", "", $faker->name),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => $password = Hash::make('secret'),
        'remember_token' => Str::random(10),
        'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
        'profile_template_id' => ProfileTemplates::inRandomOrder()->first(),
    ];
});
