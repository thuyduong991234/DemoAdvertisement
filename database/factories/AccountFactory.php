<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Account;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {
    return [
        //
        'contract_id' => \App\Models\Contract::all()->random()->id,
        'account_name' => $faker->name,
        "start_at" => $faker->unixTime($max = 'now'),
        "end_at" => $faker->unixTime($max = 'now'),
        'updated_at' => $faker->unixTime($max='now'),
        'created_at' => $faker->unixTime($max='now'),
        'login_id' => $faker->uuid,
        'login_pw' => \Illuminate\Support\Facades\Hash::make('password')
    ];
});
