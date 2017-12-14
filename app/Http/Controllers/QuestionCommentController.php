<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\QuestionComment;
use App\User;

class QuestionCommentController extends Controller
{
    //
    public function __construct()
    {
        $list_comment = QuestionComment::paginate(10);
        $list_comment->withPath('admin/question_comment/list');
        view()->share('list_comment', $list_comment);
        $list_multi = muti_level($list_comment);
        view()->share('list_multi', $list_multi);

    }

    public function getList()
    {

        return view('admin.question_user.list');
    }

    public function getAdd()
    {

        return view('admin.question_user.add');
    }

    public function postAdd(Request $request)
    {
        $this->validate($request,
            [
                'content' => 'required',
            ],
            [
                'content.required' => 'Bạn chưa chọn bài học'
            ]
        );
        //update status parent_id
        QuestionComment::where('id', $request->parent_id)->update(['status' => "Đã trả lời"]);
        $question = QuestionComment::find($request->parent_id);
        //Add reply
        $reply = new QuestionComment();
        $reply->lesson_id = $question->lesson_id;
        $reply->content = $request->content_reply;
        $reply->user_id = Auth::user()->id;
        $reply->parent_id = $request->parent_id;
        $reply->status = 'Đã trả lời';
        $reply->save();

        return redirect('admin/question_comment/list')->with('msg', 'Giải đáp thành công');
    }

    public function getDelete($id)
    {
        $question = QuestionComment::find($id);
        $reply = QuestionComment::where('parent_id', $id)->count();
        if ($question !=null) {
            if ($reply == 0) {
                $question->delete();
            } else {
                $reply->delete();
                $question->delete();
            }
            return redirect('admin/question_comment/list')->with('msg', 'Xóa thành công');
        }else{
            return redirect('admin/question_comment/list')->with('msg', 'Lỗi');
        }

    }
}
