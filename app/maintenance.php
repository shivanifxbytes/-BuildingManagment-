<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class maintenance extends Model
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
       'amount','month','pending_amount','extra_amount','user_created_at','user_id','user_status','user_created_at',
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
     *@ShortDescription Remove the updated_at column dependency from the laravel.
     *
     * @var Boolean
     */
    public $timestamps = FALSE;
    
     /**
     *@ShortDescription Override the primary key.
     *
     * @var string
     */
    //protected $primaryKey = 'user_id';
}
