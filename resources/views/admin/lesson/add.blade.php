@extends('admin.layout.index')

@section('content')
<div id="main-content-wp" class="add-cat-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_product" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Thêm bài học<    /h3>
        </div>
    </div>
    <div class="wrap clearfix">
        @include('admin.layout.sidebar')

        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    @if(count($errors) > 0)
                        <div class = 'alert alert-danger'>
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
                    <form method="POST" action="admin/lesson/add" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <label for="lesson_name">Tên bài học</label>
                        <input type="text" name="lesson_name" id="lesson_name">
                        <label>Hình ảnh</label>
                        <div id="lesson_img">
                            <input type="file" name="lesson_img" id="lesson_img" >
                        </div>
                        <label for="lesson_content">Nội dung</label>
                        <textarea class="ckeditor" name="lesson_content" id="lesson_content"></textarea>
                        <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection