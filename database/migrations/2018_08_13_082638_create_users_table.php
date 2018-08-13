<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->integer('user_type_id')->unsigned();
            $table->string('user_name', 150);
            $table->integer('flat_number');
             $table->string('owner', 150);
             $table->string('tenant', 150);
             $table->string('user_email', 191)->unique();
             $table->string('password');
              $table->decimal('carpet_area', 8, 2);
               $table->decimal('super_built_up_area', 8, 2);
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
        Schema::dropIfExists('users');
    }
}
