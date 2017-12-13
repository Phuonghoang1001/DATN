@extends("admin.layout.index")

@section('content')
    <div id="main-content-wp" class="list-product-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="admin/lesson/add" title="" id="add-new" class="fl-left">Thêm mới</a>
                <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
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
                            <form method="GET" action="admin/lesson/list" class="form-s fl-left">
                                <input type="submit" name="sm_s" value="Tìm kiếm">
                                <input type="text" name="search" id="search">
                            </form>

                            <form method="POST" action="{{url('/admin/lesson/import_data')}}"
                                  enctype="multipart/form-data" class="form-s fl-right">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <p style="color: red">{!! $errors->first('import_data') !!}</p>
                                <input type="file" name="import_file"/>
                                <button class="btn btn-primary">Import File</button>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Hình ảnh</span></td>
                                    <td><span class="thead-text">Tên bài học</span></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $num_order = 0;
                                ?>
                                @foreach($list_lesson as $lesson)
                                    <?php
                                    $num_order += 1;
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                        <td><span class="tbody-text"><h3>{{$num_order}}</h3></span></td>
                                        <td>
                                            <div class="tbody-thumb">
                                                <img src="upload/{{$lesson -> lesson_image}}" alt="" width="50px">
                                            </div>
                                        </td>
                                        <td class="clearfix"><span class="tbody-text ">{{$lesson -> lesson_name}}</span>
                                            <ul class="list-operation fl-right">
                                                <li><a href="admin/lesson/edit/{{$lesson->id}}" title="Sửa"
                                                       class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                </li>
                                                <li><a href="admin/lesson/delete/{{$lesson->id}}" title="Xóa"
                                                       class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </li>
                                            </ul>
                                        </td>

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
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection