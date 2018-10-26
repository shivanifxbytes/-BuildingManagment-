<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Config;

/**
 * Monthlyexpenses
 *
 * @package                
 * @subpackage             Monthlyexpenses
 * @category               Model
 * @DateOfCreation         22 aug 2018
 * @ShortDescription       The model is is connected to the monthly_expenses table and you can perform
 *                         relevant operation with respect to this class
 */
class Monthlyexpenses extends Model
{
    
    protected $table = 'monthly_expenses';

     /**
    * @DateOfCreation               05 Sep 2018
    * @DateOfDeprecated
    * @ShortDescription             This function selects the specified data from table
    * @LongDescription
    * @return [object]               [StdClass result object]
    */
     public static function selectMoreMonthlyExpense($date1)
     {
        return  DB::table('monthly_expenses')->select('amount', 'paid_by')
        ->where('month', $date1)
        ->get();
     }
}