@extends('layout.index')

@section('content')
    <div id="main-content-wp" class="">
        <div class="wrap clearfix">
            <div class="col-md-3">
                <div class="section" id="title-page">
                    <div class="clearfix">
                        <h3 id="index" class="text-uppercase">Danh mục</h3>
                    </div>
                </div>
                @include('layout.sidebar_user')
            </div>
            <div class="col-md-9">
                <div id="content">
                    <div class="section" id="title-page">
                        <div class="clearfix">
                            <h3 id="index" class="text-center text-uppercase">Câu hỏi của bạn</h3>
                        </div>
                    </div>
                    <div class="section" id="detail-page">
                        @if(session('err'))
                            <div class="alert alert-danger">
                                {{session('err')}}
                            </div>
                        @endif

                        @if(session('msg'))
                            <div class="alert alert-success">
                                {{session('msg')}}
                            </div>
                        @endif
                        <div class="section-detail">
                            <div class="filter-wp clearfix">
                                <form method="GET" action="user/myComment" class="form-s fl-left">
                                    <select name="select_lesson">
                                        <option value="">--Chọn bài học--</option>
                                        @foreach($lesson as $item)
                                            <option @if($select_lesson == $item->id){{"selected"}} @endif value="{!! $item->id !!}">{!! $item ->lesson_name !!}</option>
                                        @endforeach
                                    </select>
                                    <select name="select_status">
                                        <option value="">--Chọn trạng thái--</option>
                                        <option value="chưa trả lời" @if($search_status == "chưa trả lời") {!! 'selected' !!} @endif>Chưa trả lời</option>
                                        <option value="đã trả lời" @if($search_status == "đã trả lời") {!! 'selected' !!} @endif>Đã trả lời</option>
                                    </select>
                                    <input type="submit" name="sm_s" value="Tìm kiếm">
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table list-table-wp table-bordered">
                                    <thead>
                                    <tr>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Bài học</span></td>
                                        <td><span class="thead-text">Nội dung câu hỏi</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Thao tác</span></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($listComment))
                                        <?php $num_order = 0; ?>
                                        @foreach($listComment as $item)
                                            <?php $num_order += 1; ?>
                                            <tr>
                                                <td><span class="tbody-text">{!! $num_order !!}</span></td>
                                                <td><span class="tbody-text">
                                                <a href="lesson/{!! $item['lesson_id'] !!}.html">
                                                    <?php $lesson = DB::table('lesson')->where('id', $item['lesson_id'])->first();?>
                                                    @if(!empty($lesson))
                                                        {!! $lesson->lesson_name !!}
                                                    @endif
                                                </a>
                                                </span>
                                                </td>
                                                <td><span class="tbody-text">@if($item['level']!=0){!! '<i style="color:red; margin-right: 5px">Rep : </i>' !!}@endif{!!$item['content'] !!}</span></td>
                                                <td><span class="tbody-text">{!! $item ['status'] !!}</span></td>
                                                <td><span class="tbody-text "></span>
                                                    <a href="user/myComment_delete/{!! $item['id'] !!}"
                                                       title="Xóa câu hỏi của bạn"><i
                                                                class="fa fa-trash" aria-hidden="true"></i></a>
                                                    <a href="user/myComment_edit/{!! $item['id']  !!}"
                                                       title="Sửa câu hỏi của bạn"><i
                                                                class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td colspan="4"><p>Chưa có bình luận nào</p></td>
                                    @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
