<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Content;
use Faker\Generator as Faker;

$factory->define(Content::class, function (Faker $faker) {
    return [
        //
        'content_name' => $faker->name,
        'content_type' => $faker->randomElement([1,2,3]),
        'url' => $faker->url,
        'thumb_url' => $faker->url,
        'seconds' => $faker->numberBetween($min = 30, $max = 120),
        'size' => 0,
        'updated_at' => $faker->unixTime($max = 'now'),
        'created_at' => $faker->unixTime($max = 'now')
    ];
});
