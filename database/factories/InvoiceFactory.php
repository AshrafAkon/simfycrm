<?php


namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Invoice::class, function (Faker $faker) {
    return [
        'customer_id' => 1,
        'invoicestatus_id'      => 0,
        'amount'      => rand(100, 5000),
        'courier_id' => 1
    ];
});
