<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonDetail extends Model
{
    protected  $table = 'lesson_detail';
    public $timestamps = false;

    public function lesson(){
        return $this->belongsTo('App\Lesson', 'lesson_id', 'id');
    }
}
