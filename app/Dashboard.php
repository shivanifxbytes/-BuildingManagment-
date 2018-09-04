<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Config;

class Dashboard extends Model
{
	 /**
     *@ShortDescription Table for the users.
     *
     * @var String
     */
    protected $table = 'users';
 
     /**
    * @DateOfCreation         23 Aug 2018
    * @ShortDescription       Load the dashboard view 
    * @return                 View
    */
    public function queryData(){
   	return Admin::where('user_role_id', '!=' , Config::get('constants.ADMIN_ROLE'))->get();
   }
    /**
    * @DateOfCreation         23 Aug 2018
    * @ShortDescription       Load users view with list of all users 
    * @return                 View
    */
    public function countUsers(){
   	return Admin::where('user_role_id', Config::get('constants.USER_ROLE'))->count();
   }
    /**
    * @DateOfCreation         27 Aug 2018
    * @ShortDescription       Load user maintenance view with list of all maintenance 
    * @return                 View
    */
public function showUser($id)
{
    return  DB::table('user_maintenance')
            ->join('users', 'user_maintenance.user_id', '=', 'users.id')
            ->select('user_maintenance.amount', 'user_maintenance.month','user_maintenance.user_id', 'user_maintenance.pending_amount', 'extra_amount','user_maintenance.id','users.user_first_name','users.user_last_name','users.flat_number')
            ->where('user_maintenance.user_id', $id)
            ->get();
}

}
