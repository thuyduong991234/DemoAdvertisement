<?php

use Illuminate\Database\Seeder;

class DeviceLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return voids
     */
    public function run()
    {
        //
        factory(\App\Models\DeviceLog::class, 5)->create();
    }
}
