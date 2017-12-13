<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\QuestionComment;

class QuestionCommentController extends Controller
{
    //
    public function getList()
    {
        $list_commment = QuestionComment::all();
        return view('admin.question_user.list', ['list_commment'=>$list_commment]);
    }
}
