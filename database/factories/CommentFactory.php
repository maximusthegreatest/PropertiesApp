<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Comment;
use Faker\Generator as Faker;
use App\User;
use Spatie\Permission\Models\Role;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'owner_id' => function () {
        $owner = factory('App\User')->create();
        $owner->assignRole('user');
        return $owner->id;
        },
        'property_id' => function () {
            factory('App\Property')->create()->id;
        },
        'body' => $faker->paragraph
    ];
});
