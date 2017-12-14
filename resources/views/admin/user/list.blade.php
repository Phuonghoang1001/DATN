@extends("admin.layout.index")

@section('content')
<div id="main-content-wp" class="list-product-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="admin/user/register" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Danh sách học viên</h3>
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
                        <form method="GET" action="admin/user/list" class="form-s fl-left">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                            <input type="text" name="search" id="search">
                        </form>

                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp table-bordered">
                            <thead>
                            <tr>
                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Họ và tên</span></td>
                                <td><span class="thead-text">Thao tác</span></td>
                                <td><span class="thead-text">Email</span></td>
                                <td><span class="thead-text">Quyền</span></td>
                                <td><span class="thead-text">Giới Tính</span></td>
                                <td><span class="thead-text">Ngày sinh</span></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                <td><span class="tbody-text"><h3>{{$user -> id}}</h3></span></td>
                                <td ><span class="tbody-text ">{{$user -> name}}</span></td>
                                <td>
                                    <ul class="list-operation fl-right">
                                        <li><a href="admin/user/edit/{{$user->id}}" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                        <li><a href="admin/user/delete/{{$user->id}}" data-confirm ="Bạn có chắc chắn muốn xóa ?" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                    </ul>
                                </td>
                                <td><span class="tbody-text"><h3>{{$user -> email}}</h3></span></td>
                                <td><span class="tbody-text"><h3>{{$user -> role}}</h3></span></td>
                                <td><span class="tbody-text"><h3>{{$user -> gender}}</h3></span></td>
                                <td><span class="tbody-text"><h3>{{$user -> birthday}}</h3></span></td>
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
                           {!! $users->link() !!}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection