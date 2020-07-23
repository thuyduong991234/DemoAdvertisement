<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_slots', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('playlist_id');
            $table->uuid('slot_id');
            $table->integer('seq')->unsigned()->default(0);
            $table->integer('seconds')->unsigned()->default(0);
            $table->integer('created_at')->unsigned()->default(0);

            $table->foreign('slot_id')
                ->references('id')
                ->on('slots')
                ->onDelete('cascade');

            $table->foreign('playlist_id')
                ->references('id')
                ->on('playlists')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('playlist_slots', function (Blueprint $table) {
            $table->dropForeign(['playlist_id']);
            $table->dropForeign(['slot_id']);
        });

        Schema::dropIfExists('playlist_slots');
    }
}
