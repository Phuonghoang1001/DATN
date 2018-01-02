@extends('admin.layout.index')

@section('content')
    <div id="main-content-wp" class="add-cat-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="admin/user/register" title="" id="add-new" class="fl-left">Thêm mới</a>
                <h3 id="index" class="fl-left">Thêm tài khoản</h3>
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
                        <form method="POST" action="admin/register" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <label for="name">Họ tên</label>
                            <input type="text" name="name" id="name">

                            <label>Email</label>
                            <input type="email" name="email" id="email">

                            <label for="password">Mật khẩu</label>
                            <input type="password" name="password" id="password" >

                            <label for="password_confirm ">Xác nhận mật khẩu</label>
                            <input type="password_confirm" name="password_confirm"   id="password_confirm">

                            <label for="role">Quyền</label>
                            <select name="role" id="role">
                                <option value="">--Chọn quyền--</option>
                                <option value="admin">Admin</option>
                                <option value="student">Học viên</option>
                            </select>

                            <label for="gender">Giới Tính</label>
                            <label for="nam">
                                <input type="radio" name="gender" id="nam" value="Nam">Nam
                            </label>
                            <label for="nu">
                                <input type="radio" name="gender" id="nu" value="Nữ">Nữ
                            </label>

                            <label for="birthday ">Ngày sinh</label>
                            <input type="date" name="birthday" id="birthday">

                            <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection