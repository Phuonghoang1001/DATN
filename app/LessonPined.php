<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonPined extends Model
{
    //
    protected $table = 'lesson_pined';

    public function lesson(){
        return $this->belongsTo('App\Lesson', 'lesson_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
