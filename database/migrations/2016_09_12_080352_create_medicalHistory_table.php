<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicalHistory',function (Blueprint $table){
            $table->increments('id');
            $table->integer('patient_id')->unsigned();
            $table->integer('doc_id')->unsigned();
            $table->date('date');
            $table->text('prescription');
            $table->text('note')->nullable();
            $table->foreign('patient_id')->references('id')->on('patient')->onDelete('cascade');
            $table->foreign('doc_id')->references('id')->on('doctor');
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
        Schema::drop('medicalHistory');
    }
}
