<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;


use Faker\Generator as Faker;

$factory->define(\App\Courier::class, function (Faker $faker) {
    return [
        "name" => "Pathao",
        "charge" => 100
    ];
});
