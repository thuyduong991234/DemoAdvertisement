<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\DeviceLog;
use Faker\Generator as Faker;

$factory->define(DeviceLog::class, function (Faker $faker) {
    return [
        //
        'device_id' => \App\Models\Device::all()->random()->id,
        'created_at' => $faker->unixTime($max='now')
    ];
});
