<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('admin_id')->nullable()->default(NULL);
            $table->uuid('account_id')->nullable()->default(NULL);
            $table->tinyInteger('is_failed', false, true)->nullable()->default(0);
            $table->text('additions')->nullable()->default(NULL);
            $table->integer('created_at')->unsigned()->default(0);

            $table->foreign('admin_id')
                ->references('id')
                ->on('admins')
                ->onDelete('cascade');

            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
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
        Schema::table('login_logs', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
            $table->dropForeign(['admin_id']);
        });

        Schema::dropIfExists('login_logs');
    }
}
