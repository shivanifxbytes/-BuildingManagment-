<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * FlatType
 *
 * @package                
 * @subpackage             FlatType
 * @category               Model
 * @DateOfCreation         22 aug 2018
 * @ShortDescription       The model is is connected to the flat_type table and you can perform
 *                         relevant operation with respect to this class
 */
class FlatType extends Model
{
    /**
     *@ShortDescription Table for the Users.
     *
     * @var String
     */
    protected $table = 'flat_type';

    /**
    * @DateOfCreation         27 oct 2018
    * @ShortDescription       This function delete the specified row from table
    * @return                 result
    */
   public static function deleteFlatType($user_id)
   {
     return DB::table('flat_type')->where('id', '=', $user_id)->delete();
   }

}
