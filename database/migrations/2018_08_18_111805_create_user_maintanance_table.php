<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMaintananceTable extends Migration
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
				$table->decimal('amount');    
				$table->integer('month');
				$table->decimal('panding_amount');
				$table->decimal('extra_amount');
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
        Schema::dropIfExists('user_maintanance');
    }
}
