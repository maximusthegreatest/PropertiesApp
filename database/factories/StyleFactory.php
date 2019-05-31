<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use App\Style;
use Faker\Generator as Faker;

$factory->define(Style::class, function (Faker $faker) {
    return [
        'property_id' => function () {
            return factory('App\Property')->create()->id;
        },
        'style' => $faker->name,
        'description' => $faker->paragraph
    ];
});
