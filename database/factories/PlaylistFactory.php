<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Playlist;
use Faker\Generator as Faker;

$factory->define(Playlist::class, function (Faker $faker) {
    return [
        //
        'contract_id' => App\Models\Contract::all()->random()->id,
        'playlist_name' => $faker->name,
        'seconds' => $faker->randomDigit,
        'updated_at' => $faker->unixTime($max = 'now'),
        'created_at' => $faker->unixTime($max = 'now')
    ];
});
