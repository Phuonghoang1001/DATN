<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableLessonDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::dropIfExists('lesson_detail');
        Schema::create('lesson_detail', function ($table) {
            $table->increments('id');
            $table->string('detail_name');
            $table->text('detail_content');
            $table->integer('lesson_id')->unsigned();

        });
        Schema::table('lesson_detail', function($table) {
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
        Schema::drop('lesson_detail');

    }
}
