<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model {

     protected $fillable = [
        'user_name', 'user_password','user_email','owner', 'tenant','flat_number','carpet_area','super_built_up_area','id'
    ];


}
