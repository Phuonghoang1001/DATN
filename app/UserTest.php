<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTest extends Model
{
    //
    protected $table = 'user_test';

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function lesson(){
        return $this->belongsTo('App\Lesson', 'lesson_id', 'id');
    }
}
