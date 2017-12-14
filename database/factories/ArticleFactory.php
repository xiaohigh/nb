<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Article::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->name,
        'pic' => $faker->imageUrl(800,600),
        'content' => $faker->text,
        'intro' => $faker->text,
        'markdown' => '',
        'type' => 'mark',
        'cate_id' => rand(1,5)
    ];
});
