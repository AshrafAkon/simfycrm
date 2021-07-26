<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'category_id' => rand(1, 5),
        'sub_category' => $faker->country,
        'product_code' => $faker->languageCode,
        'size' => $faker->monthName,
        'color' => $faker->colorName,
        'buying_price' => rand(20, 3000),
        'selling_price' => rand(20, 3000),
        'quantity' => rand(0, 500),
        'description' => $faker->paragraph(4),

    ];
});
