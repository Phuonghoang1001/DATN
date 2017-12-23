@extends('admin.layout.index')

@section('content')
    <div id="main-content-wp" class="add-cat-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="admin/lesson_detail/add" title="" id="add-new" class="fl-left">Thêm mới</a>
                <h3 id="index" class="fl-left">Thêm học phần</h3>
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
                        <form method="POST" action="admin/lesson_detail/edit/{{$detail->id}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <label for="detail_name">Tên bài học</label>
                            <select name="lesson_id">
                                <option value='0'>---Chọn bài học---</option>
                                @foreach ($lesson as $item){
                                <option @if($detail->lesson_id == $item->id){{'selected'}} @endif value="{{$item->id}}">
                                    {{$item->lesson_name}}
                                </option>
                                }
                                @endforeach
                            </select>
                            <label for="detail_name">Tên học phần</label>
                            <input type="text" name="detail_name" id="detail_name" value="{{$detail->detail_name}}">
                            <label for="detail_content">Nội dung</label>
                            <textarea class="ckeditor" name="detail_content" id="detail_content"> {{$detail->detail_content}}</textarea>
                            <button type="submit" name="btn-submit" id="btn-submit">Sửa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection