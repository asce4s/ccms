<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work',function (Blueprint $table){
            $table->increments('id');
            $table->date('date');
            $table->time('time');
            $table->integer('emp_id')->unsigned();
            $table->foreign('emp_id')->references('id')->on('employee');
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
        Schema::drop('work');
    }
}
