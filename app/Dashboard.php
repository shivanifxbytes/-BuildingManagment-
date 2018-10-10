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
        return DB::table('maintenance_master')
        ->join('flat_type', 'maintenance_master.flat_number', '=', 'flat_type.flat_number')
        ->select('maintenance_master.id', 'maintenance_master.flat_number', 'flat_type', 'maintenance_amount')
        ->get();
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
    /**
     * @DateOfCreation         10 oct 2018
     * @ShortDescription       This function selects the flat_type for the specified id from table
     * @param  [int] $id [flat number whose id is to be retrieved]
     * @return result array
     */
    public function getFlatTypeById($id)
    {
        return DB::table('flat_type')->where('flat_number',$id)->get()->pluck('flat_type');
    }
    /**
     * [getFlatDetail description]
     * @return [type] [description]
     */
    public function getFlatDetail()
    {
                return DB::table('flat_type')->get();

    }
}
