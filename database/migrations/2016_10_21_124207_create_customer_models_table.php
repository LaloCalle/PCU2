<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_tb', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_no_ac')->nullable();
            $table->string('social_reason');
            $table->string('short_name')->nullable();
            $table->string('bl')->nullable();
            $table->string('cass_iata_nr')->nullable();
            $table->string('master_name')->nullable();
            $table->string('creation_date')->nullable();
            $table->string('ee')->nullable();
            $table->string('short_name_2')->nullable();
            $table->string('short_name_3')->nullable();
            $table->string('short_name_4')->nullable();
            $table->string('additional_information')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('no_int')->nullable();
            $table->string('no_ext')->nullable();
            $table->string('colony')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('atention_of')->nullable();
            $table->string('contact_1')->nullable();
            $table->string('telephone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();
            $table->string('email_1')->nullable();
            $table->string('email_2')->nullable();
            $table->string('bill_to_account')->nullable();
            $table->string('bill_add_ref')->nullable();
            $table->string('bill_sit')->nullable();
            $table->string('bill_media')->nullable();
            $table->string('cur_cod')->nullable();
            $table->string('lng')->nullable();
            $table->string('comm')->nullable();
            $table->string('inct_comm')->nullable();
            $table->string('pdd')->nullable();
            $table->string('gl_reference')->nullable();
            $table->string('rfc')->nullable();
            $table->string('alternate_1')->nullable();
            $table->string('alternate_2')->nullable();
            $table->string('alternate_3')->nullable();
            $table->string('broker')->nullable();
            $table->string('address_2')->nullable();
            $table->string('export_contact')->nullable();
            $table->string('import_contact')->nullable();
            $table->string('folio')->nullable();
            $table->string('serie')->nullable();
            $table->string('total')->nullable();
            $table->string('uuid')->nullable();
            $table->string('date')->nullable();
            $table->string('tim_date')->nullable();
            $table->string('update_date')->nullable();
            $table->string('file_name')->nullable();
            $table->string('font')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customer_tb');
    }
}
