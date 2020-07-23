<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ContractSeeder::class,
            AdminSeeder::class,
            AccountSeeder::class,
            ContentSeeder::class,
            DeviceSeeder::class,
            PlaylistSeeder::class,
            SlotSeeder::class,
            DevicePlaylistSeeder::class,
            PlaylistSlotSeeder::class,
            SlotContentSeeder::class
        ]);


    }
}
