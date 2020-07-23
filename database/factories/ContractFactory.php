<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Contract;
use Faker\Generator as Faker;

$factory->define(Contract::class, function (Faker $faker) {
    return [
        //
        "contract_name" => $faker->name,
        "start_at" => $faker->unixTime($max = 'now'),
        "end_at" => $faker->unixTime($max = 'now'),
        'created_at' => $faker->unixTime(),
        'updated_at' => $faker->unixTime()
    ];
});
