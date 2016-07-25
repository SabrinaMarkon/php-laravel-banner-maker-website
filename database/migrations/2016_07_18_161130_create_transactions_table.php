<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Financial transactions - commissions and sales.
        Schema::create('transactions', function(Blueprint $table) {
            $table->increments('id');
            $table->string('userid', 255);
            $table->string('transaction', 255);
            $table->string('description', 255);
            $table->dateTime('datepaid');
            $table->decimal('amount', 9, 2);
            $table->foreign('userid')->references('userid')->on('members');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transactions');
    }
}
