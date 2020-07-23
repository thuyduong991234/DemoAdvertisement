<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->uuid('id')->primary()->autoIncrement();
            $table->string('admin_name')->default('');
            $table->tinyInteger('is_locked')->nullable()->unsigned();
            $table->tinyInteger('is_disabled')->nullable()->unsigned();
            $table->string('api_token', 128)->unique()->nullable()->default(null);
            $table->integer('updated_at')->nullable();
            $table->integer('created_at');
        });

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `admins` ADD `login_id` VARBINARY(256) NOT NULL UNIQUE');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `admins` ADD `login_pw` VARBINARY(256) NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
