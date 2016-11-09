<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses',function (Blueprint $table){
            $table->increments('id');
            $table->string('task');
            $table->float('cost');
            $table->date('date');
            $table->timestamps();


        });

        Schema::drop('purchase');


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('expenses');
    }
}
