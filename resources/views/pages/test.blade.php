@extends('layout.index')
@section('content')
    <div class="container">
        <div class="test-wrapper">
            <div class="row">
                @include('layout.sidebar')
                <div class="col-md-9">
                    <div class="inner test-single">
                        <div class="row">
                            <div class="test-header clearfix">
                                <div class="col-md-7">
                                    <form action="tests/{!! $lesson_item->id !!}/load_question.html" method="GET"
                                          enctype="multipart/form-data" class="form-level" id="form-start">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <label>
                                            <input type="radio" name="level" id="easy"
                                                   value="easy">Dễ
                                        </label>
                                        <label>
                                            <input type="radio" name="level" id="medium"
                                                   value="medium">Trung bình
                                        </label>
                                        <label>
                                        <input type="radio" name="level" id="hard"
                                               value="hard">Khó
                                        </label>
                                        <button type="submit" name="btn-practice">Làm bài test</button>
                                    </form>
                                </div>
                                <div class="col-md-5" id="count-down">

                                </div>
                            </div>
                        </div>

                        <div id="list-question">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection