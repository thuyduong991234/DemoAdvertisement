<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Playlist;
use Faker\Generator as Faker;

$factory->define(Playlist::class, function (Faker $faker) {
    return [
        //
        'contract_id' => App\Models\Contract::all()->random()->id,
        'playlist_name' => $faker->name,
        'seconds' => $faker->numberBetween($min = 30, $max = 120),
        'updated_at' => $faker->unixTime($max = 'now'),
        'created_at' => $faker->unixTime($max = 'now')
    ];
});
