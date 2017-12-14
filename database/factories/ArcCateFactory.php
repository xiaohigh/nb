<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\ArcCate::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->word(),
        'pid'  => 0,
        'path' => 0
    ];
});
