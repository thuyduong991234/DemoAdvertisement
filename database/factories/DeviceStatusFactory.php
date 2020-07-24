<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\DeviceStatus;
use Faker\Generator as Faker;

$factory->define(DeviceStatus::class, function (Faker $faker) {
    return [
        //
        'device_id' => \App\Models\Device::all()->random()->id,
        'playlist_id' => \App\Models\Playlist::all()->random()->id,
        'playlist_name' => function (array $item) {
            return \App\Models\Playlist::find($item['playlist_id'])->playlist_name;
        },
        'content_id' => \App\Models\Content::all()->random()->id,
        'content_name' => function (array $item) {
            return \App\Models\Content::find($item['content_id'])->content_name;
        },
        'created_at' => $faker->unixTime($max='now')
    ];
});
