<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'production_year' => $faker->year,
        'price' => $faker->numberBetween(100, 1000),
        'description' => $faker->text,
    ];
});
