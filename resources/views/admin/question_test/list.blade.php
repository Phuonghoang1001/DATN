@extends("admin.layout.index")

@section('content')
    <div id="main-content-wp" class="list-product-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="admin/question_test/add" title="" id="add-new" class="fl-left">Thêm mới</a>
                <h3 id="index" class="fl-left">Danh sách câu hỏi kiểm tra</h3>
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
                            <form method="GET" class="form-s fl-left">
                                <select name="search_question">
                                    <option value="">--Chọn bài học--</option>
                                    @foreach($lesson as $item)
                                        <option @if($search_question == $item->id){{"selected"}} @endif value="{!! $item->id !!}">{!! $item ->lesson_name !!}</option>
                                    @endforeach
                                </select>
                                <input type="submit" name="sm_s" value="Tìm kiếm">
                            </form>
                            <form method="POST" action="admin/question_test/import_data" enctype="multipart/form-data" class = "form-s fl-right">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <p style = "color: red">{!! $errors->first('import_data') !!}</p>
                                <input type="file" name="import_file" />
                                <button class="btn btn-primary">Import File</button>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Bài học</span></td>
                                    <td><span class="thead-text">Câu hỏi</span></td>
                                    <td><span class="thead-text">Thao tác</span></td>
                                    <td><span class="thead-text">Đáp án đúng</span></td>
                                    <td><span class="thead-text">Loại câu hỏi</span></td>
                                    <td><span class="thead-text">Mức độ</span></td>
                                    <td><span class="thead-text">Số lần xuất hiện</span></td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list_question_test as $item)
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
                                        <td><span
                                                    class="tbody-text ">{{$item -> test_content}}</span></td>
                                        <td>
                                            <ul class="list-operation fl-right">
                                                <li><a href="admin/question_test/edit/{{$item ->id}}" title="Sửa"
                                                       class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                </li>
                                                <li><a href="admin/question_test/delete/{{$item ->id}}" title="Xóa"
                                                       data-confirm ="Bạn có chắc chắn muốn xóa ?"     class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </li>
                                            </ul>
                                        </td>
                                        <td><span class="tbody-text"><h3>{{$item -> right_answer}}</h3></span></td>
                                        <td><span class="tbody-text"><h3>{{$item -> type}}</h3></span></td>
                                        <td><span class="tbody-text"><h3>{{$item -> level}}</h3></span></td>
                                        <td><span class="tbody-text"><h3>{{$item -> appear}}</h3></span></td>
                                    </tr>
                                @endforeach
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
                                {!! $list_question_test ->links() !!}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection