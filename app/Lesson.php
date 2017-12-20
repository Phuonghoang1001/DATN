<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
//
    protected $table = 'lesson';
    public $timestamps = false;

    public function LessonDetail()
    {
        return $this->hasMany('App\LessonDetail', 'lesson_id', 'id');
    }

    public function QuestionTest()
    {
        return $this->hasMany('App\QuestionTest', 'lesson_id', 'id');
    }

    public function QuestionComment()
    {
        return $this->hasMany('App\QuestionComment', 'lesson_id', 'id');
    }

    public function userTest()
    {
        return $this->hasMany('App\UserTest', 'lesson_id', 'id');
    }
}
