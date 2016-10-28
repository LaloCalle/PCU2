<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_tb', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_branch')->unsigned();
            $table->string('type');
            $table->string('description');
            $table->string('name_contact');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_branch')->references('id')->on('branch_tb');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contact_tb');
    }
}
