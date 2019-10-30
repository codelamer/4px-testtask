<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Section;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Section::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'logo'=>str_pad( random_int(1,15),5,'0', STR_PAD_LEFT).'.jpg'
    ];
});
