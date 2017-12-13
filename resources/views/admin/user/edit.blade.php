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
                        <form method="POST" action="admin/user/edit/{!! $user->id !!}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <label for="name">Họ tên</label>
                            <input type="text" name="name" id="name" value="{!! $user->name !!}">

                            <label>Email</label>
                            <input type="email" name="email" id="email" value="{!! $user->email !!}"  disabled>

                            <label for="password">Bạn muốn đổi mật khẩu ?</label>
                            <input type="checkbox" name="changePass" id="changPass"><br>
                            <input type="password" name="password" id="password" class="password" disabled>

                            <label for="password_confirm ">Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirm" id="password_confirm" class="password" disabled>

                            <label for="role">Quyền</label>
                            <select name="role" id="role">
                                <option value="">--Chọn quyền--</option>
                                <option value="admin" @if ($user->role == 'admin') {!! 'selected' !!} @endif >Admin</option>
                                <option value="student" @if ($user->role == 'student') {!! 'selected' !!} @endif>Học viên</option>
                            </select>

                            <label for="gender">Giới Tính</label>
                            <label for="nam">
                                <input type="radio" name="gender" id="nam" value="Nam" @if ($user->gender == 'Nam') {!! 'checked' !!} @endif>Nam
                            </label>
                            <label for="nu">
                                <input type="radio" name="gender" id="nu" value="Nữ" @if ($user->gender == 'Nữ') {!! 'checked' !!} @endif>Nữ
                            </label>

                            <label for="birthday ">Ngày sinh</label>
                            <input type="text" name="birthday" id="birthday" value="{!! $user->birthday !!}">

                            <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
