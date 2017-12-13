<!DOCTYPE html>
<html>
<head>
    <title>AdminV1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="{{asset('')}}">
    <link href="reset.css" rel="stylesheet" type="text/css"/>
    <link href="login.css" rel="stylesheet" type="text/css"/>
    <script
            src="https://code.jquery.com/jquery-3.2.1.js"
            integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
            crossorigin="anonymous"></script>
    <script src="js/admin.js" type="text/javascript"></script>
</head>
<body>
<div id="site">
    <div id="main-content-wp" class="login-page">
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

                        <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="{{old('email')}}">
                        @if($errors->has('email'))
                            <p style="color:red">{{$errors->first('email')}}</p>
                        @endif
                    </div>
                    <div class="form-group">

                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                        @if($errors->has('password'))
                            <p style="color:red">{{$errors->first('password')}}</p>
                        @endif
                    </div>

                    <div class="form-group remember-box">

                        <input type="submit" value="Đăng nhập" name="user_login" id="btn-login">
                        <a href="">Quên mật khẩu</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>