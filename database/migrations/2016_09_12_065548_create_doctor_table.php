<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor',function (Blueprint $table){
            $table->increments('id');
            $table->integer('emp_id')->unsigned();
            $table->longText('qualifications');
            $table->string('specializedIn');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->timestamps();
            $table->foreign('emp_id')->references('id')->on('employee');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('doctor');
    }
}
