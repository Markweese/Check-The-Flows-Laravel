<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Initiative::class, function (Faker $faker) {
    return [
        'huc8' => $faker->ean8(),
        'name' => $faker->company(),
        'logo' => $faker->imageUrl($width = 70, $height = 70),
        'spokesperson' => $faker->name(),
        'spokesperson_photo' => $faker->imageUrl($width = 30, $height = 30),
        'statement' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'landing_page' => $faker->url(),
        'state_id' => rand(1, 50)
    ];
});
