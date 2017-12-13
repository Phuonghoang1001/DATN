<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableUserTest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_test', function ($table){
           $table->increments('id');
           $table->integer('user_id')->references('id')->on('users');
           $table->integer('lesson_id')->references('id')->on('lesson');
           $table->string('score');
           $table->timestamps()->notnull();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('user_test');
    }
}
