<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Config;

class Maintenance extends Model
{
    use Notifiable;
    /**
    *@ShortDescription Table for the Users.
    *
    * @var String
    */
    protected $table = 'user_maintenance';
    
    /**
     *@ShortDescription The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'amount','month','id','pending_amount','extra_amount','user_created_at','user_id','user_status','user_created_at',
    ];

    /**
     *@ShortDescription The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_password',
    ];

    /**
     * @DateOfCreation       05 Sep 2018
     * @DateOfDeprecated
     * @ShortDescription     This function selects the specified data from table
     * @LongDescription
     * @param  string $table_name
     * @param  array  $select_array
     * @param  array  $where_array
     * @return [object]               [StdClass result object]
     */
    public static function select($table_name = '', $select_array = [], $where_array = [])
    {
        $result = DB::table($table_name)->select($select_array)->where($where_array)->get();
        return $result;
    }

    /**
    * @DateOfCreation               05 Sep 2018
    * @DateOfDeprecated
    * @ShortDescription             This function selects the specified data from table
    * @LongDescription
    * @return [object]               [StdClass result object]
    */
    public static function selectMaintenance($id)
    {
        return DB::table('user_maintenance')
            ->join('users', 'user_maintenance.user_id', '=', 'users.id')
            ->select('user_maintenance.month', 'user_maintenance.user_id', 'users.flat_number')
            ->where('user_maintenance.user_id', $id)
            ->get();
        
    }
}
