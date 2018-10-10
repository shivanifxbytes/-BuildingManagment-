<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    
    /**
     *@ShortDescription Table for the users.
     *
     * @var String
     */
    protected $table = 'flats';

   // protected $table = 'user_maintenance';
    /**
     *@ShortDescription  The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tenant_id','owner_id','flat_number','carpet_area','super_built_up_area',
    ];

    /**
     *@ShortDescription The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
