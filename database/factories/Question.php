<?php

use App\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    $user_id = 1;

    $title = $faker->sentence;
    return [
        'user_id'    => $user_id,
        'channel_id' => 2,
        'title'      => $title,
        'body'       => $faker->paragraph,
        'slug'       => str_slug($title)
    ];
});
