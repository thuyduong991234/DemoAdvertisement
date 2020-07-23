<?php

use Illuminate\Database\Seeder;

class PlaylistSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\Models\PlaylistSlot::class, 5)->create();
    }
}
