<?php

namespace PCU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class MasterModel extends Model
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
    protected $table = 'master_tb';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['social_reason', 'rfc'];
     
    public function scopeName($query, $name)
    {
        if (trim($name) != "")
        {
            $query->where('social_reason', 'LIKE', '%'.$name.'%');
            // $query->where(DB::raw("CONCAT(first_name,' ',last_name)"), 'LIKE', '%'.$name.'%');
        }
    }
     
    public function scopeRfc($query, $rfc)
    {
        if (trim($rfc) != "")
        {
            $query->where('rfc', 'LIKE', '%'.$rfc.'%');
        }
    }
     
    public function scopeAddress($query, $address)
    {
        if (trim($address) != "")
        {
            $address = str_replace(',','',$address);
            $query->join('branch_tb','branch_tb.id_master','=','master_tb.id')
            ->where(DB::raw("REPLACE(CONCAT(branch_tb.street,' ',branch_tb.no_int,' ',branch_tb.no_ext,' ',branch_tb.colony,' ',branch_tb.city,' ',branch_tb.state,' ',branch_tb.country),['  ','   ','    '],'')"), 'LIKE', '%'.$address.'%');
        }
    }
     
    public function scopeContact($query, $contact)
    {
        if (trim($contact) != "")
        {
            $query->join('branch_tb','branch_tb.id_master','=','master_tb.id')
            ->join('contact_tb','contact_tb.id_branch','=','branch_tb.id')
            ->where('contact_tb.description', 'LIKE', '%'.$contact.'%');
        }
    }
}
