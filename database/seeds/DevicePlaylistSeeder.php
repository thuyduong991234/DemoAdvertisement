<?php

use Illuminate\Database\Seeder;

class DevicePlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\Models\DevicePlaylist::class, 5)->create();
    }
}
