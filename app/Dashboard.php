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
    * @ShortDescription       This function join two tables users, flat_type, and select
    *                         the specified data from tables
    * @return                 result
    */
    public function queryData()
    {
        return  DB::table('flats')
             ->join('flat_type', 'flat_type.flat_number', '=', 'flats.flat_number')
             ->join('users', 'flats.owner_id', '=', 'users.id')
            ->select('flat_type', 'flat_type.flat_number', 'carpet_area', 'user_status', 'flats.flat_number', 'users.name', 'mobile_number', 'email','users.id')
            ->where('users.user_role_id', '=', ' 2')
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
        ->where('users.user_role_id', '=', ' 2')
        ->get();
    }
 
    /**
     * @DateOfCreation         27 Aug 2018
     * @ShortDescription       This function join flat_type and maintenance_master tables
     *                         selects the specified data from table
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
     * @ShortDescription       This function select all data from flat_type table
     * @return                 result
     */
    public function selectFlatType()
    {
        return DB::table('flat_type')->get();
    }

    /**
     * @DateOfCreation         10 oct 2018
     * @ShortDescription       This function select data from flat_type table 
     * @param  [int] $id       flat number whose id is to be retrieved
     * @return                 result array
     */
    public function getFlatTypeById($id)
    {
        return DB::table('flat_type')->where('flat_number', $id)->get()->pluck('flat_type');
    }

    /**
     * @DateOfCreation         10 oct 2018
     * @ShortDescription       funtion join three tables users flat_type and flats and 
     *                         select selected data from the tables
     * @return                 result array
     */
    public function getFlatDetail()
    {
        $flat_detail =  DB::table('flats')
        ->select('flat_number', 'owner_id', 'tenant_id')
        ->get();
        foreach ($flat_detail as $key => $value) {
        $owner_id = $flat_detail[$key]->owner_id;
        $tenant_id = $flat_detail[$key]->tenant_id;
        $flat_details =  DB::table('flats')
        ->rightJoin('flat_type as ft','flats.flat_number','=','ft.flat_number')
        ->leftJoin('users as o', 'flats.owner_id', '=', 'o.id')
        ->leftJoin('users as t', 'flats.tenant_id', '=', 't.id')
        ->select('ft.flat_number', 'owner_id', 'tenant_id', 't.name as tenant_name', 'o.name as owner_name')
        ->get();
        }
        return $flat_details;
    }

    /**
     * @DateOfCreation         10 oct 2018
     * @ShortDescription       funtion join three tables users flat_type and maintenance_transaction and 
     *                         select selected data from the tables
     * @param  string $year    year field of the given year from database 
     * @param  string $month   [month field of the given month from database]
     * @return [type]          Result
     */
    public function getTransactionByMonthAndYear($year='',$month='',$limit='',$start='')
    {
        $transaction_details = DB::table('flats as f')
        ->rightJoin('flat_type as ft','f.flat_number','=','ft.flat_number')
        ->leftJoin('users as u', 'f.owner_id', '=', 'u.id')
        ->leftJoin('maintenance_transaction as t', 'f.flat_number', '=', 't.flat_number')
        ->select('ft.flat_number','t.status', 'owner_id', 'amount','pending_amount','extra_amount','u.name as owner_name','month',DB::raw('YEAR(month) as year'))
        ->where('ft.flat_number','!=','')
        ->orWhere(DB::raw('YEAR(month)'),$year)
        ->orWhere(DB::raw('MONTH(month)'),$month)
        ->limit($limit)
        ->offset($start)
        ->get();
        return $transaction_details;
    }
   
   /**
     * @DateOfCreation         10 oct 2018
     *  @ShortDescription      Funtion select all data from monthly_expenses table 
     *                         corresponding by year and month
     * @param  string $year    year field of the given year from database 
     * @param  string $month   [month field of the given month from database]
     * @return [type]          Result
     */
    public function getExpensesByMonthAndYear($year='',$month='',$limit='',$start='')
    {
        $expenses_details= DB::table('monthly_expenses')->select('amount', 'paid_by','title','paid_by','reference_number','month',DB::raw('YEAR(month) as year'))
        ->where(DB::raw('YEAR(month)'),$year)
        ->where(DB::raw('MONTH(month)'),$month)
        ->limit($limit)
        ->offset($start)
        ->get();  
        return $expenses_details;
    }

    /**
     * @DateOfCreation                10 oct 2018
     *  @ShortDescription             Funtion select data from maintenance_transaction table 
     *                                corresponding by flat_number and month
     * @param  string $flat_number    flat_number field of the given flat_number from database 
     * @param  string $month          month field of the given month from database
     * @return [type]                 Result
     */
    public function getExpensesByFlatNumber($flat_number, $month)
    {
        $expenses_details= DB::table('maintenance_transaction')->select('amount', 'flat_number','month','paid_by')
        ->where('month', '=', $month)
        ->where('flat_number', '=', $flat_number)
        ->get()->toArray();  
        return $expenses_details;
    }
}