<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('content_name', 128)->default('');
            $table->tinyInteger('content_type', false, true)->unsigned()->default(0)->comment('1:通常、2:情報、3:広告');
            $table->string('url', 1024)->nullable()->default('');
            $table->string('thumb_url', 1024)->nullable()->default('');
            $table->integer('seconds', false, true)->nullable()->default(0)->unsigned();
            $table->text('comment')->nullable()->default(null);
            $table->string('created_by', 128)->default('');
            $table->string('updated_by', 128)->nullable()->default('');
            $table->integer('updated_at')->nullable()->default(0);
            $table->integer('created_at')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
