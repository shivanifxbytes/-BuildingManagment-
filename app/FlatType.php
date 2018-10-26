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
    * @DateOfCreation         27 oct 2018
    * @ShortDescription       This function delete the specified row from table
    * @return                 result
    */
   public static function deleteFlatType($user_id)
   {
     return DB::table('flat_type')->where('id', '=', $user_id)->delete();
   }

}
