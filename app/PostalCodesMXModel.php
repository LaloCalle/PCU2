<?php

namespace PCU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostalCodesMXModel extends Model
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
    protected $table = 'postal_code_tb';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['postal_code', 'colony', 'municipality', 'state'];

    public static function postalcodes($code){
        return PostalCodesMXModel::where('postal_code',$code)->orderBy('colony')->get();
    }

    public static function state($code){
        return PostalCodesMXModel::where('postal_code',$code)->orderBy('state')->get();
    }
}
