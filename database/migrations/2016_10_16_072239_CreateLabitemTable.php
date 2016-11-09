<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabitemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labitems',function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->integer('qty');
            $table->float('price');
            $table->integer('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brand');
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
        Schema::drop('labitems');
    }
}
