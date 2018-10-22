<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaidByToMaintenanceTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maintenance_transaction', function (Blueprint $table) {
            $table->string('paid_by')->default(null)->after('reason_extra_amount');;
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
           $table->dropColumn('paid_by');
        });
    }
}
