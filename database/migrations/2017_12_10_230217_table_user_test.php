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
        Schema::create('user_test', function ($table) {
            $table->increments('id')->unsigned();
            $table->string('score');
            $table->integer('user_id')->unsigned();
            $table->integer('lesson_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('user_test', function ($table) {
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
        Schema::drop('user_test');
    }
}
