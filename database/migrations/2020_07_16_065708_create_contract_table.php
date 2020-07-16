<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('contract_name',128)->unique()->default('');
            $table->integer('start_at')->default(0);
            $table->integer('end_at')->default(0);
            $table->string('dir', 256)->default('');
            $table->text('comment')->nullable()->default(NULL);
            $table->tinyInteger('is_disabled')->nullable()->default(0)->unsigned();
            $table->integer('created_at')->unsigned()->default(0);
            $table->string('created_by', 128)->default('');
            $table->integer('updated_at')->nullable()->default(0);
            $table->string('updated_by', 128)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
