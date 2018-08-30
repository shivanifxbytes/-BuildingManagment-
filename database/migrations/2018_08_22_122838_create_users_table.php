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
            $table->increments('id');
            $table->string('user_first_name');
            $table->string('user_last_name');
            $table->integer('user_role_id')->unsigned();
            $table->string('user_email');
            $table->string('password');
            $table->string('owner')->default('');
            $table->string('tenant')->default('');
            $table->integer('flat_number')->nullable();
            $table->decimal('carpet_area')->nullable();
            $table->decimal('super_built_up_area')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
