<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableQuestionTest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('question_test', function ($table) {
            $table -> increments('id');
            $table -> string('test_content');
            $table -> string('answer_1',200);
            $table -> string('answer_2',200);
            $table -> string('answer_3',200);
            $table -> string('answer_4',200);
            $table -> string('right_answer',200);
            $table -> string('type',200);
            $table -> string('level',200);
            $table -> integer('appear');
            $table -> integer('lesson_id')->references('id')->on('lesson');
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
        Schema::drop('question_test');

    }
}
