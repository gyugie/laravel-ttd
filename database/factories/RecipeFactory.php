<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Recipe;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {
    return [
        'title'         => $faker->sentence(rand(1, 3)),
        'procedure'     => $faker->sentence(rand(1, 10))
    ];
});
