<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Admin
 *
 * @package                
 * @subpackage             Admin
 * @category               Model
 * @DateOfCreation         22 aug 2018
 * @ShortDescription       The model is is connected to the user table and you can perform
 *                         relevant operation with respect to this class
 */
class Admin extends Authenticatable
{
    use Notifiable;
    
    /**
     *@ShortDescription Table for the users.
     *
     * @var String
     */
    protected $table = 'users';

   // protected $table = 'user_maintenance';
    /**
     *@ShortDescription  The attributes that are mass assignable.
     *
     * @var array
     */
   protected $fillable = [
        'name','user_role_id','user_status','moble_number','email', 'password','user_created_at','flat_type_id',
    ];
    /**
     *@ShortDescription The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_password','remember_token',
    ];

}