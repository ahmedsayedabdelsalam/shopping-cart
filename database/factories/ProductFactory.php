<?php

use Faker\Generator as Faker;
use App\Family;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        "imagePath" => $faker->image($dir = 'public/storage/product_images', $width = 540, $height = 313, null, false),
        "title" => $faker->sentence($nbWords = 3, $variableNbWords = true),
        "description" => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        "price" => $faker->numberBetween($min = 1000, $max = 9000),
        'family_id' => Family::get()->random()->id,
    ];
});
