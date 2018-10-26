<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Flat
 *
 * @package                
 * @subpackage             Flat
 * @category               Model
 * @DateOfCreation         22 aug 2018
 * @ShortDescription       The model is is connected to the flats table and you can perform
 *                         relevant operation with respect to this class
 */
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
