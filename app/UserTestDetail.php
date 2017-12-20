<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTestDetail extends Model
{
    //
    protected $table = 'user_test_detail';
    public $timestamps = false;

    public function userTest(){
        return $this->belongsTo('App\UserTest', 'user_test_id', 'id');
    }
}
