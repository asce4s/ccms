<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule',function (Blueprint $table){
            $table->increments('id');
            $table->integer('doc_id')->unsigned();
            $table->integer('weekday');
            $table->string('fromTime');
            $table->string('toTime');
            $table->text('description');
            $table->foreign('doc_id')->references('id')->on('doctor')->onDelete('cascade');
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
        Schema::drop('schedule');
    }
}
