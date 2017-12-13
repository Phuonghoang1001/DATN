@extends('admin.layout.index')

@section('content')
    <div id="main-content-wp" class="add-cat-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="admin/question_comment/add" title="" id="add-new" class="fl-left">Thêm mới</a>
                <h3 id="index" class="fl-left">Giải đáp thắc mắc</h3>
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
                        <form method="POST" action="admin/question_comment/add" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <label for="detail_name">Tên bài học</label>
                            <select name="parent_id" id="parent_id">
                                <option value="0">------Chọn------</option>

                                @if (!empty($list_multi))
                                    @foreach ($list_multi as $item)
                                        <option value="{!! $item->id !!}"><?php echo str_repeat('--', $item['level']) . $item['content']?></option>
                                    @endforeach
                                @endif
                            </select>
                            <label for="content">Nội dung</label>
                            <input type="text" name="content_reply" id="content">
                            <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
