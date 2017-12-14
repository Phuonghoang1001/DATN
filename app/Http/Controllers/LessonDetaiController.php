<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lesson;

use App\LessonDetail;

class LessonDetaiController extends Controller
{
    //
    public function getList(Request $request)
    {
        $lesson = Lesson::all();
        $search_detail = $request->search_detail;
        if (empty($search_detail)) {
            $list_detail = LessonDetail::paginate(10);
        } else {
            $list_detail = LessonDetail::where('lesson_id', $search_detail)->get()->paginate(10);
        }
        $list_detail->withPath('admin/lesson_detail/list');
        return view('admin.lesson_detail.list', ['search_detail' => $search_detail , 'list_detail' => $list_detail, 'lesson' => $lesson]);
    }

    public function getAdd()
    {
        $lesson = Lesson::all();
        return view('admin.lesson_detail.add', ['lesson' => $lesson]);
    }

    public function postAdd(Request $request)
    {
        $this->validate($request,
            [
                'lesson_id' => 'required',
                'detail_name' => 'required',
                'detail_form' => 'required',
                'detail_content' => 'required',
            ],
            [
                'lesson_id.required' => 'Bạn chưa chọn bài học',
                'detail_name.required' => 'Bạn chưa nhập tên học phần',
                'detail_form.required' => 'Bạn chưa nhập công thức',
                'detail_content.required' => 'Nội dung học phần không được để trống',

            ]
        );
        $detail = new LessonDetail();
        $detail->lesson_id = $request->lesson_id;
        $detail->detail_name = $request->detail_name;
        $detail->detail_form = $request->detail_form;
        $detail->detail_content = $request->detail_content;
        $detail->save();
        return redirect('admin/lesson_detail/add')->with('msg', 'Thêm mới học phần thành công');
    }

    public function getEdit($id)
    {
        $lesson = lesson::all();
        $detail = LessonDetail::find($id);
        return view('admin.lesson_detail.edit', ['lesson' => $lesson, 'detail' => $detail]);
    }

    public function postEdit(Request $request, $id)
    {
        $this->validate($request,
            [
                'lesson_id' => 'required',
                'detail_name' => 'required',
                'detail_form' => 'required',
                'detail_content' => 'required',
                'detail_example' => 'required',
            ],
            [
                'lesson_id.required' => 'Bạn chưa chọn bài học',
                'detail_name.required' => 'Bạn chưa nhập tên học phần',
                'detail_form.required' => 'Bạn chưa nhập công thức',
                'detail_content.required' => 'Nội dung học phần không được để trống',
                'detail_example.required' => 'Bạn chưa nhập ví dụ',

            ]
        );
        $detail = LessonDetail::find($id);
        $detail->lesson_id = $request->lesson_id;
        $detail->detail_name = $request->detail_name;
        $detail->detail_form = $request->detail_form;
        $detail->detail_content = $request->detail_content;
        $detail->detail_example = $request->detail_example;
        $detail->save();
        return redirect('admin/lesson_detail/edit/' . $id)->with('msg', 'Sửa thành công');
    }

    public function getDelete($id)
    {
        $detail = LessonDetail::find($id);
        $detail->delete();
        return redirect('admin/lesson_detail/list')->with('msg', 'Xóa học phần thành công');
    }

    public function postImportData(Request $request)
    {
        if ($request->hasFile('import_file')) {
            $path = $request->file('import_file')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();

            if (!empty($data) && $data->count()) {
                foreach ($data->toArray() as $key => $v) {
                    $insert[] = [
                        'lesson_id' => $v['lesson_id'],
                        'detail_name' => $v['detail_name'],
                        'detail_form' => $v['detail_form'],
                        'detail_content' => $v['detail_content'],
                    ];
                }
            }
            if (!empty($insert)) {
                LessonDetail::insert($insert);
                return back()->with('success', 'Thêm file thành công');
            }
        }
        return back()->with('error', 'Vui lòng check lại ');
    }
}
