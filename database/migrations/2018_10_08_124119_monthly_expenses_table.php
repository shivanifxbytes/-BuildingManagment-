<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MonthlyExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title'); 
            $table->decimal('amount')->default(null); 
            $table->string('paid_by')->default('');
            $table->decimal('reference_number')->default(null);
            $table->decimal('total_by_cash')->default(null);
            $table->decimal('total_by_cheque')->default(null);
            $table->decimal('total_amount')->default(null);          
            $table->string('month')->default(null);
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
         Schema::dropIfExists('monthly_expenses');
    }
}
