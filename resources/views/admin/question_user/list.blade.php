@extends("admin.layout.index")

@section('content')
    <div id="main-content-wp" class="list-product-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="admin/question_user/add" title="" id="add-new" class="fl-left">Thêm mới</a>
                <h3 id="index" class="fl-left">Danh sách câu hỏi của người dùng</h3>
            </div>
        </div>
        <div class="wrap clearfix">
            @include('admin.layout.sidebar')
            <div id="content" class="fl-right">
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
                            {{--<form method="GET" class="form-s fl-left">--}}
                            {{--<select name="search_question">--}}
                            {{--<option value="">--Chọn bài học--</option>--}}
                            {{--@foreach($lesson as $item)--}}
                            {{--<option @if($search_question == $item->id){{"selected"}} @endif value="{!! $item->id !!}">{!! $item ->lesson_name !!}</option>--}}
                            {{--@endforeach--}}
                            {{--</select>--}}
                            {{--<input type="submit" name="sm_s" value="Tìm kiếm">--}}
                            {{--</form>--}}
                        </div>
                        <div class="table-responsive">
                            <table class="table list-table-wp table-bordered">
                                <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Bài học</span></td>
                                    <td><span class="thead-text">Người dùng</span></td>
                                    <td><span class="thead-text">Nội dung câu hỏi</span></td>
                                    <td><span class="thead-text">Thao tác</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($list_multi))
                                    @foreach($list_multi as $item)
                                        <tr>
                                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                            <td><span class="tbody-text"><h3>{{$item -> id}}</h3></span></td>
                                            <td>
                                            <span class="tbody-text ">
                                                <?php $lesson = DB::table('lesson')->where('id', $item->lesson_id)->first();?>
                                                @if(!empty($lesson->lesson_name))
                                                    {{ $lesson->lesson_name }}
                                                @endif
                                            </span>
                                            </td>
                                            <td ><span
                                                        class="tbody-text ">
                                                <?php $user = DB::table('users')->where('id', $item->user_id)->first();?>
                                                    @if(!empty($user))
                                                        {!! $user->name !!}
                                                    @endif
                                            </span>
                                            </td>
                                            <td><span class="tbody-text"><h3>{{$item -> content}}</h3></span></td>
                                            <td>
                                            <span class="tbody-text">
                                                <ul class="list-operation">
                                                <li><a href="admin/question_comment/edit/{{$item->id}}" title="Sửa"
                                                       @if($item->user_id != Auth::user()->id) data-role-delete = "Bạn không có quyền sửa bình luận này" @endif
                                                       class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                </li>
                                                <li><a href="admin/question_comment/delete/{{$item->id}}" title="Xóa"
                                                       data-confirm ="Bạn có chắc chắn muốn xóa ?"    class="delete"><i class="fa fa-trash" aria-hidden="true" ></i></a>
                                                </li>
                                            </ul>
                                            </span>
                                            </td>
                                            <td><span class="tbody-text"><h3>{{$item -> status}}</h3></span></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="section" id="paging-wp">
                    <div class="section-detail clearfix">
                        <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                        <ul id="list-paging" class="fl-right">
                            <li>
                                {!! $list_comment ->links() !!}
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection