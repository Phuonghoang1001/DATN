<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableLessonPin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('lesson_subscribe', function ($table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table -> integer('lesson_id')->unsigned();
        });
        Schema::table('lesson_subscribe', function($table) {
            $table->foreign('lesson_id')->references('id')->on('lesson');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::drop('lesson_subscribe');
    }
}
