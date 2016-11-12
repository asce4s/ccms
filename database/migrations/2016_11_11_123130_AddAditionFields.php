<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAditionFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedule',function (Blueprint $table){
            $table->float('fee');
        });
        Schema::table('booking',function (Blueprint $table){
            $table->integer('sale_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedule',function (Blueprint $table){
            $table->dropColumn("fee");

        });
        Schema::table('booking',function (Blueprint $table){
            $table->dropColumn("sale_id");

        });
    }
}
