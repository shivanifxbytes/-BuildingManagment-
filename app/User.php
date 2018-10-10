<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Config;

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
     *@ShortDescription Table for the users.
     *
     * @var String
     */
    protected $table = 'users';  
   
    /**
     *@ShortDescription  The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','user_role_id','user_status','mobile_number','email', 'password','user_created_at',
    ];

    /**
     *@ShortDescription The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_password','remember_token',
    ];    
  
    /**
    * @DateOfCreation         27 Aug 2018
    * @ShortDescription       This function join two table and selects the specified data from table
    * @return                 View
    */
    public function showUser($id)
    {
        return DB::table('user_maintenance')
            ->join('users', 'user_maintenance.user_id', '=', 'users.id')
            ->select('user_maintenance.amount', 'user_maintenance.month', 'user_maintenance.user_id', 'user_maintenance.pending_amount', 'extra_amount', 'users.id', 'users.user_first_name', 'users.flat_number')
            ->where('user_maintenance.user_id', $id)
            ->get();
        die();
    }

    /**
    * @DateOfCreation         23-August-2018
    * @ShortDescription       This function either get the record or terminate end
    * @param  [id]            ID of the record to be retrieved
    * @return [object]     [user record or error]
    */
    public function retrieveRecordOrTerminate($id)
    {
        return User::findOrFail($id);
    }

}
