<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PlaylistSlot;
use Faker\Generator as Faker;

$factory->define(PlaylistSlot::class, function (Faker $faker) {
    return [
        //
        'playlist_id' => \App\Models\Playlist::all()->random()->id,
        'slot_id' => \App\Models\Slot::all()->random()->id,
        'seq' => $faker->randomDigit,
        'seconds' => $faker->randomDigit,
        'created_at' => $faker->unixTime($max='now')
    ];
});
