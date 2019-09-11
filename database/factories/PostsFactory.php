<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Posts;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Posts::class, function (Faker $faker) {
    return [
        'user_id' => User::inRandomOrder()->first(),
        'created_at' => $faker->dateTimeBetween('-1 month', 'now'),
    ];
});

$factory->state(Posts::class, 'image', function (Faker $faker) {
    return [
        'filename' => $faker->word . ".jpg",
        'image_url' => $faker->imageUrl(640, 480),
        'description' => $faker->text(100),
        'type' => 'image',
    ];
});

$factory->state(Posts::class, 'text', function (Faker $faker) {
    return [
        'description' => $faker->text(300),
        'type' => 'text',
    ];
});
