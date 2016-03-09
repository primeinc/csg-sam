<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asset_id')->index();
            $table->integer('user_id')->index();
            $table->integer('checkout_id')->nullable()->index();
            $table->integer('storage_id')->nullable()->index();
            $table->string('event');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('asset_logs');
    }
}
