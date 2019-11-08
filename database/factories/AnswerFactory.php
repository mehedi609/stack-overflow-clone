<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraphs(rand(3, 7), true),
      'user_id' => Arr::random(User::pluck('id')->all()),  //User::pluck('id')->random();
      'votes_count' => rand(0, 5)
    ];
});
