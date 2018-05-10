<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Station::class, function (Faker $faker) {
    return [
        'name' => $faker->word .' river',
        'usgs_id' => $faker->unique()->ean8(),
        'lat' => $faker->latitude($min = 49, $max = 32),
        'lng' => $faker->longitude($min = -70, $max = 124),
        'state_id' => rand(1, 50),
        'huc8' => $faker->ean8()
    ];
});
