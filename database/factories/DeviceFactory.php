<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Device;
use Faker\Generator as Faker;

$factory->define(Device::class, function (Faker $faker) {
    return [
        'contract_id' => App\Models\Contract::all()->random()->id,
        'device_name' => $faker->name,
        'created_at' => $faker->unixTime($max = 'now')
    ];
});
