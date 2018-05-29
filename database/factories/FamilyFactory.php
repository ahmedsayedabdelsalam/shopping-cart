<?php

use Faker\Generator as Faker;

$factory->define(App\Family::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        "description" => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
    ];
});
