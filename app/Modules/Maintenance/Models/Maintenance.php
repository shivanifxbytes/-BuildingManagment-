<?php

namespace App\Modules\Maintenance\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model {

      protected $fillable = [
        'amount', 'month','painding_amount','extra_amount','user_id','id'
    ];


}
