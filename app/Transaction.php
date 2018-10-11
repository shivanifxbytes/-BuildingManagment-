<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Config;

class Transaction extends Model
{
    use Notifiable;
    /**
    *@ShortDescription Table for the Users.
    *
    * @var String
    */
    protected $table = 'maintenance_transaction';
    
    /**
     *@ShortDescription The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
     'amount','flat_number','tenant_name','pending_amount','extra_amount','reason_extra_amount','owner_name','reason_pending_amount','created_at','updated_at','month'
    ];

    /**
       * @DateOfCreation         27 Aug 2018
       * @ShortDescription       This function selects the specified data from table
       * @return                 Return
       */
    public static function selectMonth($flat_number)
    {
        return DB::table('maintenance_transaction')
   ->where('flat_number', '=', $flat_number)->first();
    }

    /**
    * @DateOfCreation         27 Aug 2018
    * @ShortDescription       This function selects the specified data from table
    * @return                 Return
    */
    public function selectAllTransaction()
    {
        return DB::table('maintenance_transaction')->get();
    }
}
