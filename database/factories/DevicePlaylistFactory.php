<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\DevicePlaylist;
use Faker\Generator as Faker;

$factory->define(DevicePlaylist::class, function (Faker $faker) {
    return [
        //
        'device_id' => \App\Models\Device::all()->random()->id,
        'playlist_id' => \App\Models\Playlist::all()->random()->id,
        'created_at' => $faker->unixTime($max = 'now')
    ];
});
