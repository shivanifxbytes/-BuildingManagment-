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
                $table->integer('flat_number')->unsigned();
                $table->decimal('amount')->nullable()->default(null);   
                $table->integer('month');
                $table->decimal('pending_amount');
                $table->decimal('extra_amount');
                $table->tinyInteger('user_status');
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
