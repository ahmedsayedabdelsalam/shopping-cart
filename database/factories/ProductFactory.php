<?php

use Faker\Generator as FakerG;
use Faker\Factory as Faker;
use App\Family;

$factory->define(App\Product::class, function (FakerG $faker) {
    $faker_ar = Faker::create('ar_SA');
    return [
        "imagePath" => $faker->image($dir = 'public/storage/product_images', $width = 540, $height = 313, null, false),
        "title" => $faker->sentence($nbWords = 3, $variableNbWords = true),
        "title_ar" => $faker_ar->name,
        "description" => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        "description_ar" => $faker_ar->paragraph($nbSentences = 3, $variableNbSentences = true),
        "price" => $faker->numberBetween($min = 1000, $max = 9000),
        "price_ar" => $faker_ar->numberBetween($min = 1000, $max = 9000),
        'family_id' => Family::get()->random()->id,
    ];
});
