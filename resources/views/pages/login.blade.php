@extends('layout.index')
@section('content')
<div  class="login-page">
    <div id="login-wp">
        <h1 class="page-title">Đăng nhập</h1>
        <div class="wp-form">
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                @if($errors->has('errorlogin'))
                    <div class="alert alert-danger">
                        {{$errors->first('errorlogin')}}
                    </div>
                @endif
                <div class="form-group">

                    <input type="text" class="form-control" id="email" placeholder="Email" name="email"
                           value="{{old('email')}}">
                    @if($errors->has('email'))
                        <p style="color:red">{{$errors->first('email')}}</p>
                    @endif
                </div>
                <div class="form-group">

                    <input type="password" class="form-control" id="password" placeholder="Password"
                           name="password">
                    @if($errors->has('password'))
                        <p style="color:red">{{$errors->first('password')}}</p>
                    @endif
                </div>
                <div class="form-group remember-box">
                    <input type="submit" value="Đăng nhập" name="user_login" id="btn-login">
                    <a href="">Quên mật khẩu</a>
                    <a href="register">Đăng Ký</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection