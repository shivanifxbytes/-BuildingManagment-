<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class FlatType extends Model
{
    /**
     *@ShortDescription Table for the Users.
     *
     * @var String
     */
    protected $table = 'flat_type';
    /**
     * @DateOfCreation       17 August 2018
     * @DateOfDeprecated   
     * @ShortDescription     This function selects the specified data from table
     * @LongDescription      
     * @param  string $year   
     * @param  string  $month 
     * @param  int  $flat_number  
     * @return [object]               [StdClass result object]
     */
    public static function getRecordsByMonthAndYear($year,$month,$flat_number)
    {
         $records= DB::table('maintenance_transaction')->select('flat_number')
        ->where(DB::raw('YEAR(month)'),$year)
        ->where(DB::raw('MONTH(month)'),$month)
        ->where('flat_number',$flat_number)
        ->get()->toArray();  
        return $records;
    }
    /**
     * @DateOfCreation       17 August 2018
     * @DateOfDeprecated   
     * @ShortDescription     This function updates the specified data from table
     * @LongDescription      
     * @param  string $month   
     * @param  array  $update_array 
     * @param  string  $flat_number  
     * @return [object]               [StdClass result object]
     */
    public static function updateMaintainanceData($update_array,$month,$flat_number)
    {
        return DB::table('maintenance_transaction')->where(DB::raw('MONTH(month)'),$month)
        ->where('flat_number',$flat_number)->update($update_array);
    }
}
