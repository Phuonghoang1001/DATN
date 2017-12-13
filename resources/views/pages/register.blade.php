@extends('layout.index')
@section('content')
<div  class="login-page">
    <div id="login-wp" class="register-wp">
        <h1 class="page-title">Đăng Ký</h1>
        <div class="wp-form">
            <form method="POST" action="register" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                @if($errors->has('errorlogin'))
                    <div class="alert alert-danger">
                        {{$errors->first('errorlogin')}}
                    </div>
                @endif
                <div class="form-group">
                    <lable>Họ tên</lable>
                    <input type="text" class="form-control" id="name" placeholder="Họ và tên" name="name"
                           value="{{old('name')}}">
                    @if($errors->has('name'))
                        <p style="color:red">{{$errors->first('name')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <lable>Email</lable>
                    <input type="text" class="form-control" id="email" placeholder="Email" name="email"
                           value="{{old('email')}}">
                    @if($errors->has('email'))
                        <p style="color:red">{{$errors->first('email')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <lable>Mật khẩu</lable>
                    <input type="password" class="form-control" id="password" placeholder="Password"
                           name="password">
                    @if($errors->has('password'))
                        <p style="color:red">{{$errors->first('password')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <lable>Nhập lại mật khẩu</lable>
                    <input type="password" class="form-control" id="password_confirm" placeholder="Password"
                           name="password_confirm">
                    @if($errors->has('password_confirm'))
                        <p style="color:red">{{$errors->first('password_confirm')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Giới tính</label>
                    <input type="radio" name="gender" id="nam" value="Nam">Nam
                    <input type="radio" name="gender" id="nu"  value="Nữ">Nữ
                </div>
                <div class="form-group">
                    <lable>Ngày sinh</lable>
                    <input type="date" name="birthday" class="form-control" id="birthday" >
                </div>
                <div class="form-group remember-box">
                    <input type="submit" value="Đăng Ký" name="user_login" id="btn-login">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection