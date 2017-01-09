<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabsaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labSale',function (Blueprint $table){
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->integer('qty');
            $table->integer('sale_id')->unsigned();
            $table->timestamps();
            $table->foreign('item_id')->references('id')->on('labitems')->onDelete('cascade');
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
        //
    }
}
