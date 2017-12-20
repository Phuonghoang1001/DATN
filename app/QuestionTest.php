<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionTest extends Model
{
    //
    protected $table = 'question_test';
    public $timestamps = false;

    public function lesson(){
        return $this->belongsTo('App\Lesson', 'lesson_id', 'id');
    }
}
