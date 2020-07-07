<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pahit_transaction_detil', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product')->nullable();
            $table->bigInteger('price')->nullable();
            $table->bigInteger('product_id')->nullable()->unsigned();
            $table->bigInteger('transaction_id')->nullable()->unsigned();
            $table->timestamps();
        });

        Schema::table('pahit_transaction_detil', function($table) {
            $table->foreign('product_id')->references('id')->on('pahit_product')->onDelete('set null');
            $table->foreign('transaction_id')->references('id')->on('pahit_transaction')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_detil');
    }
}
