<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionComment extends Model
{
    //
    protected $table = 'question_comment';

    public function lesson(){
        return $this->belongsTo('App\Lesson', 'lesson_id', 'id');
    }
    public function comment_reply(){
        return $this->hasMany('App\QuestionComment', 'parent_id', 'id');
    }
    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
