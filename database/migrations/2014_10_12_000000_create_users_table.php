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
			$table->integer('user_type_id')->unsigned()->default(2);
            $table->string('user_name');
            $table->string('user_email')->unique();
            $table->string('user_password');
			$table->string('owner')->default('');
			//$table->string('user_joining_date')->default('');
            $table->string('tenant')->default('');
			$table->integer('flat_number')->nullable();
			$table->decimal('carpet_area')->nullable();
            $table->decimal('super_built_up_area')->nullable();
			$table->boolean('isAdmin')->nullable();
			$table->tinyInteger('is_deleted')->default(2);
            $table->rememberToken();
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
