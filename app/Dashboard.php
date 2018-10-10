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
                //return DB::table('flat_type')->get();

    $flat_detail =  DB::table('flats')
        ->select('flat_number', 'owner_id','tenant_id')
        ->get();
        $array = [];
        $newarray = [];
        foreach ($flat_detail as $key => $value) {
        $owner_id = $flat_detail[$key]->owner_id;
    /*    array_push($array,DB::table('flats')
        ->join('users', 'flats.owner_id', '=', 'users.id')
        ->select('flat_number', 'owner_id','tenant_id','name as owner_name')
        ->where('owner_id',$owner_id)
        ->where('user_role_id',2)
        ->get());*/
        array_push($array, DB::table('users')->select('name as owner_name')->where('id',$owner_id)->where('user_role_id',2)->get());
        $tenant_id = $flat_detail[$key]->tenant_id;
    /*    array_push($newarray,DB::table('flats')
        ->join('users', 'flats.tenant_id', '=', 'users.id')
        ->select('flat_number', 'owner_id','tenant_id','name as tenant_name')
        ->where('tenant_id',$tenant_id)
        ->where('user_role_id',3)
        ->get());*/
                   array_push($newarray, DB::table('users')->select('name as tenant_name')->where('id',$tenant_id)->where('user_role_id',3)->get());
        }
        $flat_detail = $array;
        $flat_detail_new = $newarray;
        echo "<pre>";
        print_r($flat_detail);
        print_r($flat_detail_new);
        die;
        return $flat_detail;
           }
}
