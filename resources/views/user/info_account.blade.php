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
                            <h3 id="index" class="text-center text-uppercase">Thông tin tài khoản</h3>
                        </div>
                    </div>
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
                            <form method="POST" action="user/edit" enctype="multipart/form-data"
                                  class="form-info">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">

                                <label for="name">Họ tên</label>
                                <input type="text" name="name" id="name" value="{!! Auth::user()->name !!}">

                                <label>Email</label>
                                <input type="email" name="email" id="email" value="{!! Auth::user()->email !!}"
                                       disabled>

                                <label for="password">Bạn muốn đổi mật khẩu ?</label>
                                <input type="checkbox" name="changePass" id="changPass"><br>
                                <input type="password" name="password" id="password" class="password" disabled>

                                <label for="password_confirm ">Xác nhận mật khẩu</label>
                                <input type="password" name="password_confirm" id="password_confirm" class="password"
                                       disabled>

                                <label for="gender">Giới Tính</label>
                                <label for="nam">
                                    <input type="radio" name="gender" id="nam"
                                           value="Nam" @if( Auth::user()->gender == 'Nam') {!! 'checked' !!} @endif >Nam
                                </label>
                                <label for="nu">
                                    <input type="radio" name="gender" id="nu"
                                           value="Nữ" @if( Auth::user()->gender == 'Nữ') {!! 'checked '!!} @endif >Nữ
                                </label>

                                <label for="birthday ">Ngày sinh</label>
                                <input type="date" name="birthday" id="birthday" value="{!! Auth::user()->birthday !!}">

                                <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
