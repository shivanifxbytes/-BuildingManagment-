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
    * @ShortDescription       This function selects the specified data from table
    * @return                 result
    */
    public function queryData()
    {
        return Admin::where('user_role_id', '!=', Config::get('constants.ADMIN_ROLE'))->get();
    }

    /**
    * @DateOfCreation         23 Aug 2018
    * @ShortDescription       This function selects the specified data from table
    * @return                 result
    */
    public function countUsers()
    {
        return Admin::where('user_role_id', Config::get('constants.USER_ROLE'))->count();
    }
    /**
    * @DateOfCreation         27 Aug 2018
    * @ShortDescription       This function join two table and selects the specified data from table
    * @return                 result
    */
    public function showUser($id)
    {
        return  DB::table('user_maintenance')
            ->join('users', 'user_maintenance.user_id', '=', 'users.id')
            ->select('user_maintenance.amount', 'user_maintenance.month', 'user_maintenance.user_id', 'user_maintenance.pending_amount', 'extra_amount', 'user_maintenance.id', 'users.user_first_name', 'users.user_last_name', 'users.flat_number')
            ->where('user_maintenance.user_id', $id)
            ->get();
    }
 
    /**
      * @DateOfCreation         27 Aug 2018
      * @ShortDescription       This function selects the specified data from table
      * @return                 result
      */
    public function selectMaintenance()
    {
        return DB::table('maintenance_master')->get();
    }

    /**
        * @DateOfCreation         27 Aug 2018
        * @ShortDescription       This function selects the specified data from table
        * @return                 result
        */
    public function selectFlatType()
    {
        return DB::table('flat_type')->get();
    }
}
