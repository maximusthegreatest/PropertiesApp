<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Property;
use Faker\Generator as Faker;

$factory->define(Property::class, function (Faker $faker) {
    $name = $faker->name;
//    $seedImgs = array('seedImage1.jpg', 'seedImage2.jpg', 'seedImage3.jpg');
//    $randPos = array_rand($seedImgs, 1);
//    $randomImg = $seedImgs[$randPos];


    return [
        'admin_id' => function () {
            factory('App\User')->create()->assignRole('admin');
            },
        'name' => $name,
        'description' => $faker->paragraph,
        'available_on' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'rating' => $faker->numberBetween(1 , 5),
        'slug' => str_slug($name, '-'),
        'price' => $faker->numberBetween(100000, 500000),
        'country' => $faker->country,
        'photo' => $faker->image()
    ];
});
