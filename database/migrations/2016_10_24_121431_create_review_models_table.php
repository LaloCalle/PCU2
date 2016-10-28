<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_tb', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_master')->unsigned();
            $table->integer('id_customer')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_master')->references('id')->on('master_tb');
            $table->foreign('id_customer')->references('id')->on('customer_tb');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('review_tb');
    }
}
