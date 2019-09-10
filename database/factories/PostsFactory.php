<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Posts;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Posts::class, function (Faker $faker) {
    return [
        'user_id' => \App\Models\User::inRandomOrder()->first(),
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
