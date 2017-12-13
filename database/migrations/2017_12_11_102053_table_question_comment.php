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
        Schema::create('question_comment', function ($table) {
            $table->increments('id');
            $table->string('content');
            $table->integer('parent_id')->references('id')->on('question_comment');
            $table->integer('user_id');
            $table->integer('lesson_id')->references('id')->on('lesson');
            $table->string('status');
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
        //
        Schema::drop('question_comment');

    }
}
