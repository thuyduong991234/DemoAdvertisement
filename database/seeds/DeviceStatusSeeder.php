<?php

use Illuminate\Database\Seeder;

class DeviceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\Models\DeviceStatus::class, 5)->create();
    }
}
