<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Myfuntion extends Model
{
    protected $table="canteens";

   public function users(){
    return Admin::where('user_role_id', '!=' , Config::get('constants.ADMIN_ROLE'))->get();
   }
}
