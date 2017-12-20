<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role', 'gender', 'birthday'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function comment(){
        return $this->hasMany('App\QuestionComment', 'user_id', 'id');
    }

    public function lessonFavourite(){
        return $this->hasMany('App\LessonFavourite', 'user_id', 'id');
    }

    public function lessonPined(){
        return $this->hasMany('App\LessonPined', 'user_id', 'id');
    }

    public function userTest(){
        return $this->hasMany('App\UserTest', 'user_id', 'id');
    }
}
