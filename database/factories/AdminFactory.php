<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        //
        'admin_name' => $faker->name,
        'updated_at' => $faker->unixTime($max='now'),
        'created_at' => $faker->unixTime($max='now'),
        'login_id' => $faker->safeEmail,
        'login_pw' => 'password'
        //'login_pw' => 'hello'
    ];
});
