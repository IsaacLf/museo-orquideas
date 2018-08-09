<?php

use Faker\Generator as Faker;

$factory->define(App\Entry::class, function (Faker $faker) {
    return [
        'title' => $faker->bothify('Orquidea ?###'), 
        'synonym'=> $faker->text(20), 
        'distribution' => $faker->text(30), 
        'description' => $faker->text(60),
        'image' => NULL, 
        'imageType' => NULL, 
        'author' => $faker->randomElement(['admin', 'isaaclf']),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});
