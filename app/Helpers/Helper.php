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
    public static function getUserName($id)
    {
        $data= DB::table('user_maintenance')
            ->join('users', 'user_maintenance.user_id', '=', 'users.id')
            ->select('user_maintenance.amount', 'user_maintenance.month','user_maintenance.user_id', 'user_maintenance.pending_amount', 'extra_amount','user_maintenance.id','users.user_first_name','users.flat_number')
            ->where('user_maintenance.user_id', $id)
            ->First();
            print_r($data);
            die();

    }
}
