<?php

use Illuminate\Database\Seeder;

class SlotContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\Models\SlotContent::class, 5)->create();
    }
}
