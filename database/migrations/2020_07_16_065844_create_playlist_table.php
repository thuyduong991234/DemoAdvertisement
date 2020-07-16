<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlists', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('contract_id');
            $table->string('playlist_name', 128)->default('');
            $table->integer('refresh_span_seconds', false, true)->default(NULL)->nullable();
            $table->tinyInteger('version_update_type', false, true)->default(0)->comment('0:自動更新、1:プレイリスト更新時刻')->nullable();
            $table->text('comment')->nullable()->default(NULL);
            $table->integer('seconds')->unsigned()->default(0);
            $table->string('created_by', 128)->default('');
            $table->string('updated_by', 128)->nullable()->default('');
            $table->integer('updated_at')->nullable()->default(0);
            $table->integer('created_at')->unsigned()->nullable()->default(0);

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
        Schema::table('playlists', function (Blueprint $table) {
            $table->dropForeign(['contract_id']);
        });

        Schema::dropIfExists('playlists');
    }
}
