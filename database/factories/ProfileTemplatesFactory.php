<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProfileTemplates;
use Faker\Generator as Faker;

$factory->define(ProfileTemplates::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'created_at' => now(),
    ];
});
