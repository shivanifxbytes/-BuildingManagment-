<?php
namespace App\Helpers;
use DB;

class Helper
{
	 /**
    * @DateOfCreation         29 Aug 2018
    * @ShortDescription       
    * @return       
    */
    public static function getUserName($user_id)
    {
       $data = DB::table('user_maintenance')
            ->join('users', 'user_maintenance.user_id', '=', 'users.id')
            ->select('user_maintenance.user_id','users.id','users.user_first_name','users.user_last_name')
            ->where('user_maintenance.user_id', $user_id)
            ->first();

        return $data->user_first_name;
    }
}