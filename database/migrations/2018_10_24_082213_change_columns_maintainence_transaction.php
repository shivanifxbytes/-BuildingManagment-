<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnsMaintainenceTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::table('maintenance_transaction', function (Blueprint $table) {
            $table->decimal('pending_amount')->default(null)->nullable()->change();
            $table->string('reason_pending_amount')->default(null)->nullable()->change();
            $table->decimal('extra_amount')->default(null)->nullable()->change();
            $table->string('reason_extra_amount')->default(null)->nullable()->change();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('maintenance_transaction', function (Blueprint $table) {
            $table->decimal('pending_amount')->default(null)->nullable(false)->change();
            $table->string('reason_pending_amount')->default(null)->nullable(false)->change();
            $table->decimal('extra_amount')->default(null)->nullable(false)->change();
            $table->string('reason_extra_amount')->default(null)->nullable(false)->change(); 
       });
    }
}
