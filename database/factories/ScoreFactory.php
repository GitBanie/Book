<?php

use Faker\Generator as Faker;

$factory->define(App\Score::class, function (Faker $faker) {
    return [
        //
        'book_id' => random_int(\DB::table('books')->min('id'), \DB::table('books')->max('id')),
        'ip' => $faker->unique()->ipv4(), //Valeur par defaut
        'vote' => $faker->numberBetween(1, 5)
    ];
});
