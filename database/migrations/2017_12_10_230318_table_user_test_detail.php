<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableUserTestDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_test_detail', function($table){
            $table->increments('id');
            $table->integer('user_test_id')->references('id')->on('user_test');
            $table->integer('test_id')->references('id')->on('question_test');
            $table->string('my_answer');
            $table->string('right_answer');
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
        Schema::drop('user_test_detail');
    }
}
