<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee',function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('nic',10)->unique();
            $table->string('designation');
            $table->text('addr');
            $table->timestamps();



        });

        Schema::table('users', function ($table) {
            $table->foreign('emp_id')->references('id')->on('employee')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('users', function ($table) {
            $table->dropForeign('users_emp_id_foreign');
        });
        Schema::drop('employee');

    }
}
