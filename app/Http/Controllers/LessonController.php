<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lesson;

use App\LessonDetail;

use App\Excel;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    //
    public function getList(Request $request)
    {
        $search = $request->search;

        if (empty($search)) {
            $list_lesson = Lesson::paginate(10);
            $list_lesson->withPath('admin/lesson/list');
            return view('admin.lesson.list', ['list_lesson' => $list_lesson]);
        } else {
            $list_lesson = Lesson::where('lesson_name', 'Like', '%' . $search . '%')->get()->paginnate(10);
            $list_lesson->withPath('admin/lesson/list');
            return view('admin.lesson.list', ['list_lesson' => $list_lesson, 'search' => $search]);
        }
    }

    public function getAdd()
    {
        return view('admin.lesson.add');
    }

    public function postAdd(Request $request)
    {
        $this->validate($request,
            [
                'lesson_name' => 'required',
                'lesson_content' => 'required',

            ],
            [
                'lesson_name.required' => 'Bạn chưa nhập tên bài học',
                'lesson_content.required' => 'Bạn chưa nhập nội dung bài học',
            ]
        );
        $lesson = new Lesson;
        $lesson->lesson_name = $request->lesson_name;
        $lesson->lesson_content = $request->lesson_content;
        if ($request->hasFile('lesson_img')) {
            $file = $request->file('lesson_img');
            $extension = $file->getClientOriginalExtension();
            if ($extension != "jpg" && $extension != "png") {
                return redirect('admin/lesson/add')->with('err', 'Chỉ được chọn file có đuôi là jpg và png');
            }
            $name = $file->getClientOriginalName();
            $img = str_random(4) . "_" . $name;
            while (file_exists("upload/image" . $img)) {
                $img = str_random(4) . "_" . $name;
            }
            $file->move("upload/image", $img);
            $lesson->lesson_image = $img;
        } else {
            $lesson->lesson_image = "";
        }
        $lesson->save();
        return redirect('admin/lesson/add')->with('msg', 'Thêm bài học thành công');
    }

    public function getEdit($ID)
    {
        $lesson = Lesson::find($ID);
        return view('admin.lesson.edit', ['lesson' => $lesson]);
    }

    public function postEdit(Request $request, $ID)
    {
        $this->validate($request,
            [
                'lesson_name' => 'required',
                'lesson_content' => 'required',
            ],
            [
                'lesson_name.required' => 'Bạn chưa nhập tên bài học',
                'lesson_content.required' => 'Bạn chưa nhập nội dung bài học',
            ]
        );
        $lesson = Lesson::find($ID);
        $lesson->lesson_name = $request->lesson_name;
        $lesson->lesson_content = $request->lesson_content;
        if ($request->hasFile('lesson_img')) {
            $file = $request->file('lesson_img');
            $extension = $file->getClientOriginalExtension();
            if ($extension != "jpg" && $extension != "png") {
                return redirect('admin/lesson/edit')->with('err', 'Chỉ được chọn file có đuôi là jpg và png');
            }
            $name = $file->getClientOriginalName();
            $img = str_random(4) . "_" . $name;
            while (file_exists("upload/image" . $img)) {
                $img = str_random(4) . "_" . $name;
            }
            if (!empty($lesson->lesson_image)) {
                unlink("upload/image" . $lesson->lesson_image);
                $file->move("upload/image", $img);
                $lesson->lesson_image = $img;
            } else {
                $file->move("upload/image", $img);
                $lesson->lesson_image = $img;
            }
        }
        $lesson->save();
        return redirect('admin/lesson/list')->with('msg', 'Sửa thành công');
    }

    public function getDelete($ID)
    {
        $lesson = Lesson::find($ID);
        $lesson_detail = LessonDetail::where('lesson_id', $ID)->count();
        if ($lesson_detail == 0) {
            $lesson->delete();
            return redirect('admin/lesson/list')->with('msg', 'Xóa bài học thành công');
        } else {
            return redirect('admin/lesson/list')->with('err', 'Không thể xóa bài học');
        }
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
                        'lesson_name' => $v['lesson_name'],
                        'lesson_content' => $v['lesson_content'],
                        'lesson_img' => $v['lesson_img'],
                    ];
                }
            }
            if (!empty($insert)) {
                Lesson::insert($insert);
                return back()->with('msg', 'Thêm file thành công');
            }
        }
        return back()->with('error', 'Vui lòng check lại ');
    }

}
