<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use App\Lesson;
use App\LessonDetail;
use App\QuestionTest;
use App\QuestionComment;
use App\User;
use App\LessonFavourite;
use App\LessonPined;
use App\UserTest;
use App\UserTestDetail;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //
    function __construct()
    {
        $lesson = Lesson::all();
        view()->share('lesson', $lesson);

        $lesson_detail = LessonDetail::all();
        view()->share('lesson_detail', $lesson_detail);
    }

    function home()
    {
        return view('pages.home');
    }

    function lesson($id)
    {
        $favourite = LessonFavourite::all();
        $followed = LessonPined::all();
        $lesson_item = Lesson::find($id);
        $lesson_detail = LessonDetail::where('lesson_id', $id)->get();
        $question_test = QuestionTest::where('lesson_id', $id)->where('level', 'easy')->get();
        $question_comment = QuestionComment::where('lesson_id', $id)->get();
        $multi_level = muti_level($question_comment);
        return view('pages.lesson',
            [
                'lesson_item' => $lesson_item,
                'lesson_detail' => $lesson_detail,
                'question_test' => $question_test,
                'question_comment' => $multi_level,
                'favourite' => $favourite,
                'followed' => $followed
            ]);
    }

    function test($id)
    {
        $lesson_item = Lesson::find($id);
        return view('pages.test', ['lesson_item' => $lesson_item]);
    }

    function loadQuestion(Request $request, $test_id)
    {
        $level = $request->level;
        if (empty($level)) {
            $question_test = '';
        } else {
            $question_test = QuestionTest::where('lesson_id', $test_id)->where('level', $level)->get();
        }
        $lesson_item = Lesson::find($test_id);
        return view('pages.load_question', ['question_test' => $question_test, 'lesson_item' => $lesson_item, 'level' => $level]);
    }

    function postAnswer(Request $request, $id)
    {
        $level = $request->level;
        $lesson_item = Lesson::find($id);
        $question_test = QuestionTest::where('lesson_id', $id)->where('level', $level)->get();
        $correct = array();
        $wrong = array();
        $answer_question = array();
        //Kiểm tra đáp án
        $data = array();
        foreach ($question_test as $question) {
            $right_answer = $question->right_answer;
            if (isset($_POST["answer_{$question->id}"])) {
                $answer = $_POST["answer_{$question->id}"];
                if ($right_answer == $answer) {
                    $correct[$question->id] = $answer;
                } else {
                    $wrong[$question->id] = $answer;
                }
                $answer_question[$question->id] = $answer;
                $data[] = [
                    'test_id' => $question->id,
                    'my_answer' => $answer,
                    'right_answer' => $right_answer
                ];
            } else {
                $answer_question[$question->id] = '';
            }
        }

        //Tính điểm và lưu bài kiểm tra
        if (!empty($correct) && !empty($wrong)) {
            $score = count($correct).'/'.count($question_test);
        } else {
            $score = 0;
        }
        $user_test = new UserTest();
        $user_test_id = $user_test->insertGetId(
            [
                'user_id' => Auth::user()->id,
                'lesson_id' => $lesson_item->id,
                'score' => $score,
                'created_at' => now()->toDateTimeString(),
            ]);

        //Lưu đáp án bài kiểm tra
        foreach ($data as $item) {
            $user_test_detail = new UserTestDetail();
            $user_test_detail->user_test_id = $user_test_id;
            $user_test_detail->test_id = $item['test_id'];
            $user_test_detail->my_answer = $item['my_answer'];
            $user_test_detail->right_answer = $item['my_answer'];
            $user_test_detail->save();
        }
        return view('pages.result', ['correct' => $correct, 'wrong' => $wrong, 'question_test' => $question_test, 'lesson_item' => $lesson_item, 'level' => $level, 'answer' => $answer_question]);
    }

    function getLogin()
    {
        //get link page current
        session(['link' => url()->previous()]);
        return view('pages.login');
    }

    function postLogin(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:3'
        ];
        $messages = [
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 3 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $email = $request->input('email');
            $password = $request->input('password');

            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                //back page previous after login
                return redirect(session('link'));
            } else {
                $errors = new MessageBag(['errorlogin' => 'Email hoặc mật khẩu không đúng']);
                return redirect()->back()->withInput()->withErrors($errors);
            }
        }
    }

    function getLogout()
    {
        Auth::logout();
        return redirect('home');
    }

    function getRegister()
    {
        return view('pages.register');
    }

    function postRegister(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:32',
                'password_confirm' => 'required|same:password',
            ],
            [
                'name.required' => 'Bạn chưa chọn bài học',
                'name.min' => 'Tên phải có ít nhất 3 ký tự',

                'email.required' => 'Bạn chưa nhập email',
                'email.email' => 'Chưa nhập đúng định dạng email',
                'email.unique' => 'Email đã tồn tại',

                'password.required' => 'Chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
                'password.max' => 'Mật khẩu không được quá 32 kí tự',

                'password_confirm.required' => 'Chưa nhập xác nhận mật khẩu',
                'password_confirm.sam' => 'Mật khẩu chưa khớp',

            ]
        );
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = "student";
        $user->gender = $request->gender;
        $user->birthday = $request->birthday;

        $user->save();

        return redirect('login');
    }

    function postComment(Request $request, $id)
    {
        $question_comment = new QuestionComment();
        $question_comment->content = $request->comment;
        $question_comment->parent_id = 0;
        $question_comment->user_id = Auth::user()->id;
        $question_comment->lesson_id = $id;
        $question_comment->status = 'Chưa duyệt';
        $question_comment->save();
        return redirect('lesson/' . $id . '.html');
    }
}
