@extends('admin.layout.index')

@section('content')
    <div id="main-content-wp" class="add-cat-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="?page=add_product" title="" id="add-new" class="fl-left">Thêm mới</a>
                <h3 id="index" class="fl-left">Sửa câu hỏi</h3>
            </div>
        </div>
        <div class="wrap clearfix">
            @include('admin.layout.sidebar')

            <div id="content" class="fl-right">
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        @if(count($errors) > 0)
                            <div class='alert alert-danger'>
                                @foreach($errors ->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif

                        @if(session('msg'))
                            <div class="alert alert-success">
                                {{session('msg')}}
                            </div>
                        @endif
                        <form method="POST" action="admin/question_test/edit/{{$question_test->id}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <label for="lesson_id">Bài học</label>
                            <select name="lesson_id">
                                <option value="">-- Chọn bài học --</option>
                                @foreach($lesson as $item)
                                    <option @if ($question_test->lesson_id == $item->id) {{'selected'}} @endif value="{!! $item->id !!}">{!! $item->lesson_name !!}</option>
                                @endforeach
                            </select>
                            <label for="question_level">Mức độ</label>
                            <select name="question_level">
                                <option value="{!! $question_test->level !!}">{!! $question_test->level !!}</option>
                                <option value="easy">Dễ</option>
                                <option value="medium">Trung bình</option>
                                <option value="hard">Khó</option>
                            </select>
                            <label for="question_type">Loại câu hỏi</label>
                            <select name="question_type" id="question_type">
                                <option value="{!! $question_test->type !!}">{!! $question_test->type !!}</option>
                                <option value="reading">Reading</option>
                                <option value="listening">Listening</option>
                            </select>

                            <label for="test_content">Câu hỏi</label>
                            @if($question_test->type = 'reading')
                                <input type="text" name="test_content_reading" id="question_reading"
                                       value="{!! $question_test->test_content !!}" class="type_reading">
                            @else
                                <input type="file" name="test_content_listening" id="question_listening"
                                       value="{!! $question_test->test_content !!}" class="type_listening">
                            @endif
                            <label for="answer_1">Đáp án 1</label>
                            <input type="text" name="answer_1" value="{!! $question_test->answer_1 !!}">
                            <label for="answer_2">Đáp án 2</label>
                            <input type="text" name="answer_2" value="{!! $question_test->answer_2 !!}">
                            <label for="answer_3">Đáp án 3</label>
                            <input type="text" name="answer_3" value="{!! $question_test->answer_3 !!}">
                            <label for="answer_4">Đáp án 4</label>
                            <input type="text" name="answer_4" value="{!! $question_test->answer_4 !!}">
                            <label for="right_answer">Đáp án đúng</label>
                            <input type="text" name="right_answer" value="{!! $question_test->right_answer !!}">
                            <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection