<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Config;

class Maintenance extends Model
{
     use Notifiable;
     /**
     *@ShortDescription Table for the Users.
     *
     * @var String
     */
    protected $table = 'user_maintenance';
    
    /**
     *@ShortDescription The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'amount','month','id','pending_amount','extra_amount','user_created_at','user_id','user_status','user_created_at',
    ];

    /**
     *@ShortDescription The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_password',
    ];

}
