<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use App\QuestionTest;
use Excel;
class QuestionTestController extends Controller
{
    //
    public function getList(Request $request)
    {
        $lesson = Lesson::all();
        $search_question = $request->search_question;
        if (empty($search_question)) {
            $list_question_test = QuestionTest::paginate(5);
        } else {
            $list_question_test = QuestionTest::where('lesson_id', $search_question)->get()->paginate(5);
        }
        return view('admin.question_test.list', ['search_question' => $search_question, 'list_question_test' => $list_question_test, 'lesson' => $lesson]);
    }

    public function getAdd()
    {
        $lesson = Lesson::all();
        return view('admin.question_test.add', ['lesson' => $lesson]);
    }

    public function postAdd(Request $request)
    {
        $this->validate($request,
            [
                'lesson_id' => 'required',
                'answer_1' => 'required',
                'answer_2' => 'required',
                'answer_3' => 'required',
                'answer_4' => 'required',
                'right_answer' => 'required',
            ],
            [
                'lesson_id.required' => 'Bạn chưa chọn bài học',
                'answer_1.required' => 'Bạn chưa nhập đáp án 1',
                'answer_2.required' => 'Bạn chưa nhập đáp án 2',
                'answer_3.required' => 'Bạn chưa nhập đáp án 3',
                'answer_4.required' => 'Bạn chưa nhập đáp án 4',
                'right_answer.required' => 'Bạn chưa nhập đáp án đúng',
            ]
        );
        $question_test = new QuestionTest;
        $question_test->lesson_id = $request->lesson_id;
        if ($request->question_type == 'reading') {
            $question_test->test_content = $request->test_content_reading;
        } else {
            if ($request->hasFile('test_content_listening')) {
                $file = $request->file('test_content_listening');
                $extension = $file->getClientOriginalExtension();
                if ($extension != "mp4") {
                    return redirect('admin/question_test/add')->with('err', 'Chỉ được chọn file có đuôi là mp4');
                }
                $name = $file->getClientOriginalName();
                $audio = str_random(4) . "_" . $name;
                while (file_exists("upload/audio" . $audio)) {
                    $audio = str_random(4) . "_" . $name;
                }
                $file->move("upload", $audio);
                $question_test->test_content = $audio;
            }
        }
        $question_test->answer_1 = $request->answer_1;
        $question_test->answer_2 = $request->answer_2;
        $question_test->answer_3 = $request->answer_3;
        $question_test->answer_4 = $request->answer_4;
        $question_test->right_answer = $request->right_answer;
        $question_test->type = $request->question_type;
        $question_test->level = $request->question_level;
        $question_test->appear = 0;
        $question_test->save();
        return redirect('admin/question_test/list')->with('msg', 'Thêm câu hỏi kiểm tra thành công');
    }

    public function getEdit($id)
    {
        $lesson = Lesson::all();
        $question_test = QuestionTest::find($id);
        return view('admin.question_test.edit', ['lesson' => $lesson, 'question_test' => $question_test]);
    }

    public function postEdit(Request $request, $id)
    {
        $this->validate($request,
            [
                'lesson_id' => 'required',
                'answer_1' => 'required',
                'answer_2' => 'required',
                'answer_3' => 'required',
                'answer_4' => 'required',
                'right_answer' => 'required',
            ],
            [
                'lesson_id.required' => 'Bạn chưa chọn bài học',
                'answer_1.required' => 'Bạn chưa nhập đáp án 1',
                'answer_2.required' => 'Bạn chưa nhập đáp án 2',
                'answer_3.required' => 'Bạn chưa nhập đáp án 3',
                'answer_4.required' => 'Bạn chưa nhập đáp án 4',
                'right_answer.required' => 'Bạn chưa nhập đáp án đúng',
            ]
        );
        $question_test = QuestionTest::find($id);
        $question_test->lesson_id = $request->lesson_id;
        if ($request->question_type == 'reading') {
            $question_test->test_content = $request->test_content_reading;
        } else {
            if ($request->hasFile('test_content_listening')) {
                $file = $request->file('test_content_listening');
                $extension = $file->getClientOriginalExtension();
                if ($extension != "mp4" && $extension != 'jpg' && $extension != "png") {
                    return redirect('admin/question_test/add')->with('err', 'Chỉ được chọn file có đuôi là mp4');
                }
                $name = $file->getClientOriginalName();
                $audio = str_random(4) . "_" . $name;
                while (file_exists("upload/audio" . $audio)) {
                    $audio = str_random(4) . "_" . $name;
                }
                $file->move("upload", $audio);
                unlink("upload/" . $question_test->test_content);
                $question_test->test_content = $audio;
            }
        }
        $question_test->answer_1 = $request->answer_1;
        $question_test->answer_2 = $request->answer_2;
        $question_test->answer_3 = $request->answer_3;
        $question_test->answer_4 = $request->answer_4;
        $question_test->right_answer = $request->right_answer;
        $question_test->type = $request->question_type;
        $question_test->level = $request->question_level;
        $question_test->appear = 0;
        $question_test->save();
        return redirect('admin/question_test/list')->with('msg', 'Sửa câu hỏi kiểm tra thành công');
    }

    public function getDelete($id)
    {
        $question_test = QuestionTest::find($id);
        $question_test->delete();
        return redirect('admin/question_test/list')->with('msg', 'Xóa câu hỏi kiểm tra thành công');
    }

    public function postImportData(Request $request)
    {
        if ($request->hasFile('import_file')) {
            $path = $request->file('import_file')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();

            if (!empty($data) && count($data) > 0) {
                foreach ($data->toArray() as $key => $v) {
                    $insert[] = [
                        'lesson_id' => $v['lesson_id'],
                        'test_content' => $v['test_content'],
                        'answer_1' => $v['answer_1'],
                        'answer_2' => $v['answer_2'],
                        'answer_3' => $v['answer_3'],
                        'answer_4' => $v['answer_4'],
                        'right_answer' => $v['right_answer'],
                        'type' => $v['type'],
                        'level' => $v['level'],
                        'appear' => $v['appear'],
                    ];
                }
            }
            if (!empty($insert)) {
                QuestionTest::insert($insert);
                return back()->with('success', 'Thêm file thành công');
            }
        }
        return back()->with('error', 'Vui lòng check lại ');
    }
}
