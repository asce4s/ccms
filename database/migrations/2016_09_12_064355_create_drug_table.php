<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug',function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->float('price');
            $table->text('description')->nullable();
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
        Schema::drop('drug');
    }
}
