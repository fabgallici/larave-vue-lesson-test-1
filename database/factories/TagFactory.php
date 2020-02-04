<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Tag;

$factory->define(Tag::class, function (Faker $faker) {
    return [

      'name' => $faker -> word,
      'description' => $faker -> sentence

    ];
});
