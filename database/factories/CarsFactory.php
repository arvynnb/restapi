<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Car;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(Car::class, function (Faker $faker) {
    return [
        'name'    => $faker->randomElement(['Vios', 'Jazz','Fortuner','Wigo','Mirage']),
        'brand'   => $faker->randomElement(['Toyota', 'Honda','Mitsubishi','Hyundai']),
        'color'   => $faker->randomElement(['Blue', 'Red','Green','Yellow','Black','Gray','White','Maroon']),
    ];
});
