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
    * @ShortDescription       This function join three tables users, flat_type,and flats and selects the *                         specified data from tables
    * @return                 result
    */
    public function queryData()
    {
         return  DB::table('flats')
             ->leftJoin('flat_type', 'flat_type.flat_number', '=', 'flats.flat_number')
             ->rightJoin('users', 'flats.owner_id', '=', 'users.id')
            ->select('flat_type', 'flat_type.flat_number', 'carpet_area','user_status', 'flats.flat_number', 'users.name', 'mobile_number', 'email')
            ->where('users.user_role_id' ,'=',' 2')
            ->get();
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
    * @ShortDescription       This function join two tables and selects the specified data from tables
    * @return                 result
    */
    public function showUser($id)
    {
        return  DB::table('flats')
             ->leftJoin('flat_type', 'flat_type.flat_number', '=', 'flats.flat_number')
            ->select('flat_type', 'flat_type.flat_number', 'carpet_area', 'flats.flat_number', 'users.name', 'mobile_number', 'email')
            ->where('users.user_role_id' ,'=',' 2')
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

    public function getFlatTypeById($id)
    {
        return DB::table('flat_type')->where('flat_number',$id)->get()->pluck('flat_type');
    }
}
