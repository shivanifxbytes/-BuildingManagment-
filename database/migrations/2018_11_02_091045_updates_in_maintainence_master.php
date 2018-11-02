<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatesInMaintainenceMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maintenance_master', function (Blueprint $table) {
             $table->integer('flat_type_id')->unsigned();
             $table->dropColumn('flat_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maintenance_master', function (Blueprint $table) {
             $table->dropColumn('flat_type_id');
             $table->integer('flat_number')->unique();
        });
    }
}
