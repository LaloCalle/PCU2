<?php

namespace PCU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchModel extends Model
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
    protected $table = 'branch_tb';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_master', 'code', 'branch_description', 'country', 'state', 'city', 'street', 'no_int', 'no_ext', 'colony', 'postal_code', 'status_match', 'id_unique_customer'];
     
    public function scopeName($query, $name)
    {
        $query->join('master_tb','branch_tb.id_master','=','master_tb.id');
        if (trim($name) != "")
        {
            $query->where('master_tb.social_reason', 'LIKE', '%'.$name.'%');
            // $query->where(DB::raw("CONCAT(first_name,' ',last_name)"), 'LIKE', '%'.$name.'%');
        }
    }
     
    public function scopeRfc($query, $rfc)
    {
        if (trim($rfc) != "")
        {
            $query->where('master_tb.rfc', 'LIKE', '%'.$rfc.'%');
        }
    }
     
    public function scopeContact($query, $contact)
    {
        $query->join('contact_tb','contact_tb.id_branch','=','branch_tb.id');
        if (trim($contact) != "")
        {
            $query->where('contact_tb.description', 'LIKE', '%'.$contact.'%');
        }
    }
     
    public function scopeCountry($query, $country)
    {
        if (trim($country) != "")
        {
            $query->join('country_catalogue_tb','country_catalogue_tb.code','=','branch_tb.country')
            ->where('country_catalogue_tb.name', 'LIKE', '%'.$country.'%');
        }
    }
     
    public function scopeCity($query, $city)
    {
        if (trim($city) != "")
        {
            $query->join('city_catalogue_tb','city_catalogue_tb.code','=','branch_tb.city')
            ->where('city_catalogue_tb.name', 'LIKE', '%'.$city.'%');
        }
    }
     
    public function scopeState($query, $state)
    {
        if (trim($state) != "")
        {
            $query->where('branch_tb.state', 'LIKE', '%'.$state.'%');
        }
    }
     
    public function scopePostalcode($query, $postalcode)
    {
        if (trim($postalcode) != "")
        {
            $query->where('branch_tb.postalcode', 'LIKE', '%'.$postalcode.'%');
        }
    }
     
    public function scopeColony($query, $colony)
    {
        if (trim($colony) != "")
        {
            $query->where('branch_tb.colony', 'LIKE', '%'.$colony.'%');
        }
    }
     
    public function scopeStreet($query, $street)
    {
        if (trim($street) != "")
        {
            $query->where('branch_tb.street', 'LIKE', '%'.$street.'%');
        }
    }
     
    public function scopeNoext($query, $noext)
    {
        if (trim($noext) != "")
        {
            $query->where('branch_tb.noext', 'LIKE', '%'.$noext.'%');
        }
    }
     
    public function scopeNoint($query, $noint)
    {
        if (trim($noint) != "")
        {
            $query->where('branch_tb.noint', 'LIKE', '%'.$noint.'%');
        }
    }
}
