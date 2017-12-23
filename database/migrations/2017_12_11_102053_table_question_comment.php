<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableQuestionComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::drop('question_comment');
        Schema::create('question_comment', function ($table) {
            $table->increments('id');
            $table->string('content');
            $table->integer('parent_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('lesson_id')->unsigned();
            $table->string('status');
            $table->timestamps();
        });
        Schema::table('question_comment', function ($table){
            $table->foreign('parent_id')->references('id')->on('question_comment');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('lesson_id')->references('id')->on('lesson');
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
        Schema::drop('question_comment');

    }
}
