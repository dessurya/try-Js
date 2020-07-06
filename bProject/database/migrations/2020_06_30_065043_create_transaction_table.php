<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pahit_transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('amount')->nullable();
            $table->string('customer')->nullable();
            $table->bigInteger('customer_id')->nullable()->unsigned();
            $table->timestamps();
        });

        Schema::table('pahit_transaction', function($table) {
            $table->foreign('customer_id')->references('id')->on('pahit_customer')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction');
    }
}
