<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use Faker\Generator as Faker;

$factory->define(App\Customer::class, function (Faker $faker) {
    return [
        'name'    => $faker->name(),
        'phone'   => $faker->phoneNumber,
        'address' => $faker->address,
    ];
});
