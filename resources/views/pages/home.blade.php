@extends('layout.index')
@section('content')
    <section class="main">
        <div class="container">
            <header class="course-header">
                <h1 class="course-header__title">Khóa học của tôi</h1>
                <div class="header__line"></div>
            </header>
            <div class="course-main">
                <div class="row">
                    @foreach($lesson as $item)
                    <div class="col-md-4">
                        <div class="course-item clearfix">
                            <a href="lesson/{{$item->id}}.html" class="course-item__link">
                                <img src="upload/{{$item->lesson_image}}" alt="" class="img-responsive">
                            </a>
                            <div class="course-info">
                                <h4 class="course-item__title"><a  href="lesson/{{$item->id}}.html">{!! $item->lesson_name !!}</a></h4>
                                <p class="course-item__desc">{!! str_limit($item->lesson_content, $limit = 100, $end = '...' ) !!}</p>
                                <a href="lesson/{{$item->id}}.html" class="course-item__btn">Học tiếp</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </section>
@endsection