<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('contract_id')->nullable();
            $table->string('account_name')->default('');
            $table->integer('start_at')->default(0);
            $table->integer('end_at')->default(0);
            $table->tinyInteger('is_locked')->nullable()->unsigned()->default(0);
            $table->tinyInteger('is_disabled')->nullable()->unsigned()->default(0);
            $table->string('api_token', 128)->unique()->nullable()->default(null);
            $table->integer('updated_at')->nullable()->default(0);
            $table->integer('created_at')->unsigned()->nullable()->default(0);
        });

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `accounts` ADD `login_id` VARBINARY(256) NOT NULL UNIQUE');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `accounts` ADD `login_pw` VARBINARY(256) NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
