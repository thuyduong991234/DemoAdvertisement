<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('contract_id');
            $table->string('device_name', 128)->nullable()->default('');
            $table->string('socket_id', 128)->nullable()->default('');
            $table->string('platform', 16)->nullable()->default('');
            $table->text('additions')->nullable()->default(NULL);
            $table->text('comment')->nullable()->default(NULL);
            $table->integer('created_at')->unsigned()->default(0);

            $table->foreign('contract_id')
                ->references('id')
                ->on('contracts')
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
        Schema::table('devices', function (Blueprint $table) {
            $table->dropForeign(['contract_id']);
        });

        Schema::dropIfExists('devices');
    }
}
