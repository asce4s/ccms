<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabTestSale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labTestSale',function (Blueprint $table){
            $table->increments('id');
            $table->integer('test_id')->unsigned();
            $table->integer('sale_id')->unsigned();
            $table->timestamps();
            $table->foreign('test_id')->references('id')->on('labtest')->onDelete('cascade');
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('labTestSale');
    }
}
