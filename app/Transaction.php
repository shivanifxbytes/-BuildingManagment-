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
       'amount','flat_number','tenant_name','pending_amount','extra_amount','reason_extra_amount','owner_name','reason_pending_amount','created_at','updated_at',
    ];

    /**
     *@ShortDescription The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_password',
    ];
    

    /**
    * @DateOfCreation         23 Aug 2018
    * @ShortDescription       Select data from maintenance transaction table 
    * @return                 Response
    */
    public static function selectMonth($flat_number)
    {
        return DB::table('maintenance_transaction')
        ->where('flat_number', '=', $flat_number)->first();
    }
}
