<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Course::class, function (Faker $faker) {
    return [
        'title' => $faker->word(),
        'pic' => $faker->imageUrl(400,300),
        'content' => $faker->text(),
        'content_m' => $faker->text(),
        'price' => rand(1,999),
        'status' => 1
    ];
});
