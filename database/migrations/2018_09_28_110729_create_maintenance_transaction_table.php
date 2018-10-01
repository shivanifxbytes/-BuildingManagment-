<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenanceTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->string('flat_number')->unique();
            $table->string('tenant_name')->default('');
            $table->string('owner_name')->default('');    
            $table->decimal('amount')->nullable()->default(null); 
            $table->decimal('pending_amount');
            $table->string('reason_pending_amount')->default('');
            $table->decimal('extra_amount');
            $table->string('reason_extra_amount')->default('');
            $table->decimal('card_number')->nullable()->default(null);
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
        Schema::dropIfExists('maintenance_transaction');
    }
}
