<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SlotContent;
use Faker\Generator as Faker;

$factory->define(SlotContent::class, function (Faker $faker) {
    return [
        //
        'slot_id' => \App\Models\Slot::all()->random()->id,
        'content_id' => \App\Models\Content::all()->random()->id,
        'seq' => $faker->numberBetween($min = 30, $max = 120),
        'seconds' => $faker->numberBetween($min = 30, $max = 120),
        'created_at' => $faker->unixTime($max='now')
    ];
});
