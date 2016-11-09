<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddItemCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('labitems',function (Blueprint $table){
            $table->string('itemcode')->unique();
            $table->integer('minqty');
        });

        Schema::table('drug',function (Blueprint $table){
            $table->string('itemcode')->unique();
            $table->integer('minqty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('labitems',function (Blueprint $table){

            $table->dropColumn("itemcode");
            $table->dropColumn("minqty");
        });

        Schema::table('drug',function (Blueprint $table){
            $table->dropColumn("itemcode");
            $table->dropColumn("minqty");
        });
    }
}
