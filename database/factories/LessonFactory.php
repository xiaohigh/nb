<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Lesson::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'video' => $faker->imageUrl(500,300),
        'long' => rand(4,1000),
        'pos' => rand(1,5)
    ];
});
