<?php

namespace PCU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerModel extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customer_tb';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['customer_no_ac', 'social_reason', 'short_name', 'bl', 'cass_iata_nr', 'master_name', 'creation_date', 'ee', 'short_name_2', 'short_name_3', 'short_name_4', 'additional_information', 'country', 'state', 'city', 'street', 'no_int', 'no_ext', 'colony', 'postal_code', 'atention_of', 'contact_1', 'telephone', 'mobile', 'fax', 'email_1', 'email_2', 'bill_to_account', 'bill_add_ref', 'bill_sit', 'bill_media', 'cur_cod', 'lng', 'comm', 'inct_comm', 'pdd', 'gl_reference', 'rfc', 'alternate_1', 'alternate_2', 'alternate_3', 'broker', 'address_2', 'export_contact', 'import_contact', 'folio', 'serie', 'total', 'uuid', 'date', 'tim_date', 'update_date', 'file_name', 'font'];
}
