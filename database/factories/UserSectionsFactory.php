<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserSection;
use Faker\Generator as Faker;

$factory->define(UserSection::class, function (Faker $faker) {
    return [
        'user_id' => random_int(1,15),
        'section_id' => random_int(1,15),
    ];
});
