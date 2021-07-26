<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\ExpenseRecords::class, function (Faker $faker) {
    return [
        "name" => $faker->company,
        "description" => $faker->text(20),
        "amount" => rand(10, 450),
        "date" => date("Y-m-d")
    ];
});
