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

$factory->define(App\Models\Reading::class, function (Faker $faker) {
    return [
        'station_id' => rand(1, 1000),
        'cfs' => rand(100,10000),
        'ph' => rand(5, 9),
        'temp' => rand(32, 75),
        'conductance' => rand(50, 5000),
        'reading_time' => $faker->dateTime($max = 'now', $timezone = null)
    ];
});
