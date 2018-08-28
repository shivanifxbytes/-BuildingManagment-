<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
/**
 * User
 *
 * @package                BlogProject
 * @subpackage             Blog
 * @category               Model
 * @DateOfCreation         24 aug 2018
 * @ShortDescription       The model is is connected to the users table and you can perform
 *                         relevant operation with respect to this class
 **/
class User extends Authenticatable
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
        'amount','month','pending_amount','extra_amount','user_created_at','user_id'
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
