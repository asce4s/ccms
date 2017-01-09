<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel',function (Blueprint $table){
            $table->increments('id');
            $table->integer('patient_id')->nullable()->unsigned();
            $table->integer('schedule_id')->unsigned();
            $table->date('date');
            $table->integer('token');
            $table->integer('saleId');
            $table->foreign('patient_id')->references('id')->on('patient')->onDelete('cascade');
            $table->foreign('schedule_id')->references('id')->on('schedule')->onDelete('cascade');
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
        Schema::drop('channel');
    }
}
