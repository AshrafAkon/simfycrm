<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Expense::class, function (Faker $faker) {
    return [
        "date" => date("d-m-Y"),
        "amount" => rand(500, 5000)
    ];
});
