<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_tb', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_master')->unsigned();
            $table->string('code');
            $table->string('branch_description');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('street');
            $table->string('no_int');
            $table->string('no_ext');
            $table->string('colony');
            $table->string('postal_code');
            $table->string('status_match');
            $table->string('id_unique_customer');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_master')->references('id')->on('master_tb');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('branch_tb');
    }
}
