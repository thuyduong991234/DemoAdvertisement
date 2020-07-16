<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_status', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('device_id');
            $table->string('app_version', 16)->nullable()->default('');
            $table->string('platform_info', 128)->nullable()->default(null);
            $table->bigInteger('storage_capacity_bytes', false, true)->nullable()->default(null);
            $table->bigInteger('storage_freespace_bytes', false, true)->nullable()->default(null);
            $table->string('ip4_address', 16)->nullable()->default(null);
            $table->string('ip6_address', 128)->nullable()->default('');
            $table->string('mode', 16)->nullable()->default('');
            $table->uuid('playlist_id')->nullable()->default(null);
            $table->string('playlist_name', 128)->nullable()->default('');
            $table->uuid('content_id')->nullable()->default(null);
            $table->string('content_name', 128)->nullable()->default('');
            $table->bigInteger('download_total_bytes', false, true)->nullable()->default(null);
            $table->bigInteger('download_bytes', false, true)->nullable()->default(null);
            $table->string('push_token', 128)->nullable()->default('');
            $table->integer('created_at')->unsigned()->default(0);

            $table->foreign('device_id')
                ->references('id')
                ->on('devices')
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
        Schema::table('device_status', function (Blueprint $table) {
            $table->dropForeign(['device_id']);
        });

        Schema::dropIfExists('device_status');
    }
}
