<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlotContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slot_contents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('slot_id');
            $table->uuid('content_id');
            $table->integer('seq')->unsigned()->default(0);
            $table->integer('seconds')->unsigned()->default(0);
            $table->integer('created_at')->unsigned()->default(0);

            $table->foreign('content_id')
                ->references('id')
                ->on('contents')
                ->onDelete('cascade');

            $table->foreign('slot_id')
                ->references('id')
                ->on('slots')
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
        Schema::table('slot_contents', function (Blueprint $table) {
            $table->dropForeign(['slot_id']);
            $table->dropForeign(['content_id']);
        });

        Schema::dropIfExists('slot_contents');
    }
}
