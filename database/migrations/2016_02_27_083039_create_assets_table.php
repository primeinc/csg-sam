<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('mfr_id')->unsigned()->index();
            $table->string('part', 100);
            $table->string('description', 250);
            $table->string('ack', 250);
            $table->decimal('msrp', 6, 2);
            $table->string('image');
            $table->tinyInteger('status')->default(1)->index();
            $table->string('notes');
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
        Schema::drop('assets');
    }
}
