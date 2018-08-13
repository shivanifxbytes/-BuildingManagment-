<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMaintenanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_maintenance', function (Blueprint $table) {
           $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->decimal('amount', 8, 2);    
            $table->integer('month');
             $table->decimal('panding_amount', 8, 2);
              $table->decimal('extra_amount', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_maintenance');
    }
}
