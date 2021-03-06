<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\LessonFavourite;
use App\LessonPined;
use App\Lesson;
use App\QuestionComment;
use App\UserTest;
use App\UserTestDetail;

class userPageController extends Controller
{

    //InfoAccount
    public function getInfoAccount()
    {
        return view('user.info_account');
    }

    public function postEditAccount(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|min:3',
            ],
            [
                'name.required' => 'Bạn chưa chọn bài học',
                'name.min' => 'Tên phải có ít nhất 3 ký tự',
            ]
        );
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->birthday = $request->birthday;
        if ($request->changePass == "on") {
            $this->validate($request,
                [
                    'password' => 'required|min:6|max:32',
                    'password_confirm' => 'required|same:password',
                ],
                [
                    'password.required' => 'Chưa nhập mật khẩu',
                    'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
                    'password.max' => 'Mật khẩu không được quá 32 kí tự',

                    'password_confirm.required' => 'Chưa nhập xác nhận mật khẩu',
                    'password_confirm.sam' => 'Mật khẩu chưa khớp',
                ]
            );
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect('user/myAccount')->with('msg', 'Cập nhật tài khoản thành công');
    }

//    button favourite
    public function getLessonFavouriteAdd($lesson_id)
    {
        $lesson_favourite = new LessonFavourite();
        $lesson_favourite->user_id = Auth::user()->id;
        $lesson_favourite->lesson_id = $lesson_id;
        $lesson_favourite->save();
    }

    public function getLessonFavouriteDelete($lesson_id)
    {
        LessonFavourite::where(['lesson_id' => $lesson_id, 'user_id' => Auth::user()->id])->delete();
    }

//    get list favourite
    public function getLessonFavourite()
    {
        $favourites = LessonFavourite::where('user_id', Auth::user()->id)->get();
        return view('user.lesson_favourite', ['favourites' => $favourites]);
    }

//    button followed
    public function getLessonFollowedAdd($lesson_id)
    {
        $lesson_pined = new LessonPined();
        $lesson_pined->user_id = Auth::user()->id;
        $lesson_pined->lesson_id = $lesson_id;
        $lesson_pined->save();
    }

    public function getLessonFollowedDelete($lesson_id)
    {
        LessonPined::where(['lesson_id' => $lesson_id, 'user_id' => Auth::user()->id])->delete();
    }

//    get list followed
    public function getLessonFollowed()
    {
        $followed = LessonPined::where('user_id', Auth::user()->id)->get();
        return view('user.lesson_followed', ['followed' => $followed]);
    }

    //get list my comment
    public function getMyComment(Request $request)
    {
        $lesson = Lesson::all();
        $status = $request->select_status;
        $select_lesson = $request->select_lesson;
        if (empty($status)) {
            if (empty($select_lesson)) {
                $user_commment = QuestionComment::where('user_id', Auth::user()->id)->get()->toArray();
            } else {
                $user_commment = QuestionComment::where('user_id', Auth::user()->id)->where('lesson_id', $select_lesson)->get()->toArray();
            }
        } else {
            if (empty($select_lesson)) {
                $user_commment = QuestionComment::where('user_id', Auth::user()->id)->where('status', $status)->get()->toArray();
            } else {
                $user_commment = QuestionComment::where('user_id', Auth::user()->id)->where('status', $status)->where('lesson_id', $select_lesson)->get()->toArray();

            }
        }
        foreach ($user_commment as $item) {
            $reply = QuestionComment::where('parent_id', $item['id'])->get()->toArray();
        }
        if (!empty($reply)) {
            $list_comment = array_merge($user_commment, $reply);
            $multi_level = muti_level($list_comment);
        } else {
            $multi_level = muti_level($user_commment);
        }
        return view('user.myComment', ['listComment' => $multi_level, 'search_status' => $status, 'select_lesson' => $select_lesson, 'lesson' => $lesson]);

    }

    public function getMyTestList(Request $request)
    {
        $select_lesson = $request->select_lesson;
        $date = $request->date;
        $lesson = Lesson::all();
        if (empty($select_lesson)) {
            if (empty($date)) {
                $test_list = UserTest::where('user_id', Auth::user()->id)->get();
            } else {
                $test_list = UserTest::where('user_id', Auth::user()->id)->where('created_at', 'Like', '%' . $date . '%')->get();
            }
        } else {
            if (empty($date)) {
                $test_list = UserTest::where('user_id', Auth::user()->id)->where('lesson_id', $select_lesson)->get();
            } else {
                $test_list = UserTest::where('user_id', Auth::user()->id)->where('lesson_id', $select_lesson)->where('created_at', 'Like', '%' . $date . '%')->get();
            }
        }
        return view('user.myTestList', ['test_list' => $test_list, 'select_lesson' => $select_lesson, 'lesson' => $lesson]);
    }

    public function getMyTestDetail($id)
    {
        $test_detail = UserTestDetail::where('user_test_id', $id)->get();
        return view('user.myTestDetail', ['test_detail' => $test_detail]);
    }
}
