<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use DB;

class Master extends Model
{
    use Notifiable;
    /**
    *@ShortDescription Table for the Users.
    *
    * @var String
    */
    protected $table = 'maintenance_master';
    
    /**
     *@ShortDescription The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'maintenance_amount','flat_type','id','created_at',
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
    * @DateOfCreation         27 Aug 2018
    * @ShortDescription       Load user maintenance view with list of all maintenance 
    * @return                 View
    */
    public function getFlatId($user_id)
    {
        return DB::table('flat_type')
        ->where('id', '=', $user_id)->count();
       
    }  

    /**
    * @DateOfCreation         27 Aug 2018
    * @ShortDescription       Load user maintenance view with list of all maintenance 
    * @return                 View
    */
    public function findFlatId($user_id)
    {
         return DB::table('flat_type')
        ->where('id', '=', $user_id)->get()->toArray();
    }

      /**
     * @DateOfCreation       11 September 2018
     * @DateOfDeprecated
     * @ShortDescription     This function insert the specified data into table
     * @LongDescription
     * @param  string $table_name
     * @param  array  $insert_array
     * @return void
     */
    public static function insert($table_name = '', $insert_array = [])
    {
        return DB::table($table_name)->insertGetId($insert_array);
    }

    /**
    * @DateOfCreation         27 Aug 2018
    * @ShortDescription       Load user maintenance view with list of all maintenance 
    * @return                 View
    */
public function selectFlatType()
{
    return DB::table('flat_type')->get();

}


}
