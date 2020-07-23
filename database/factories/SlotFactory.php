<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Slot;
use Faker\Generator as Faker;

$factory->define(Slot::class, function (Faker $faker) {
    return [
        //
        'slot_name' => $faker->name,
        'created_at' => $faker->unixTime($max='now')
    ];
});
