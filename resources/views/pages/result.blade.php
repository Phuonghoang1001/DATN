@extends('layout.index')
@section('content')
    <div class="test-wrapper">
        <div class="container">
            <div class="wrapper">
                <div class="row">
                    @include('layout.sidebar')
                    <div class="col-md-9">
                        <div class="inner">
                            <div class="row">
                                <div class="col-md-7">
                                    <form action="tests/{!! $lesson_item->id !!}/load_question.html" method="GET"
                                          enctype="multipart/form-data" class="form-level" id="form-start">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <label>
                                            <input type="radio" name="level" id="easy"
                                                   value="easy" @if($level == 'easy'){!! "checked " !!}@endif>Dễ
                                        </label>
                                        <label>
                                            <input type="radio" name="level" id="medium"
                                                   value="medium" @if($level == 'medium'){!! "checked " !!}@endif>Trung bình
                                        </label>
                                        <input type="radio" name="level" id="hard"
                                               value="hard" @if($level == 'hard'){!! "checked " !!}@endif>Khó
                                        </label>

                                        <a href="test/{!! $lesson_item->id !!}.html" class="pull-right btn-refresh">@if(count($correct) < 4 ) {!! 'Làm lại <i class="fa fa-refresh" aria-hidden="true"></i>' !!} @else {!! 'Level khác <i class="fa fa-angle-double-right" aria-hidden="true"></i>' !!} @endif</a>
                                    </form>
                                </div>
                                <div class="col-md-5">
                                    <div id="count-down">

                                    </div>
                                    <div class="result-test">Điểm của bạn : <strong>{!! count($correct) !!} / {!!  count($question_test)!!} </strong> @if(count($correct) < 4 ) {!! 'Lêu lêu' !!} @else {!! 'vỗ tay' !!} @endif</div>
                                </div>
                            </div>

                            @if(!empty($question_test))
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <?php $num = 0; ?>
                                    @foreach($question_test as $item)
                                        <?php $num++; ?>
                                        <div class="question-item">
                                            <b>Câu {!! $num !!} : </b>
                                            <span>{!! $item->test_content !!}</span> <br>
                                            <label>
                                                <input type="radio" name="answer_{!! $item->id !!}"
                                                       @if( $item->answer_1 == $item->right_answer) {!! 'checked '!!} @endif
                                                       value="{!! $item->answer_1 !!}">
                                                @if(isset($wrong["{$item->id}"]) && $answer["{$item->id}"] == $wrong["{$item->id}"] && $answer["{$item->id}"] == $item->answer_1 )
                                                    <span style="color:red;"><i class="fa fa-times" aria-hidden="true"></i> {!! $item->answer_1 !!}</span>
                                                @else
                                                    {!! $item->answer_1 !!}
                                                @endif
                                            </label>
                                            <label>
                                                <input type="radio" name="answer_{!! $item->id !!}"
                                                       @if( $item->answer_2 == $item->right_answer) {!! 'checked '!!} @endif
                                                       value="{!! $item->answer_2 !!}">
                                                @if(isset($wrong["{$item->id}"]) && $answer["{$item->id}"] == $wrong["{$item->id}"] && $answer["{$item->id}"] == $item->answer_2 )
                                                    <span style="color:red;"><i class="fa fa-times" aria-hidden="true"></i> {!! $item->answer_2 !!}</span>
                                                @else
                                                    {!! $item->answer_2 !!}
                                                @endif
                                            </label>
                                            <label>
                                                <input type="radio" name="answer_{!! $item->id !!}"
                                                       @if( $item->answer_3 == $item->right_answer) {!! 'checked '!!} @endif
                                                       value="{!! $item->answer_3 !!}">
                                                @if(isset($wrong["{$item->id}"]) && $answer["{$item->id}"] == $wrong["{$item->id}"] && $answer["{$item->id}"] == $item->answer_3 )
                                                    <span style="color:red;"><i class="fa fa-times" aria-hidden="true"></i> {!! $item->answer_3 !!}</span>
                                                @else
                                                    {!! $item->answer_3 !!}
                                                @endif
                                            </label>
                                            <label>
                                                <input type="radio" name="answer_{!! $item->id !!}"
                                                       @if( $item->answer_4 == $item->right_answer) {!! 'checked '!!} @endif
                                                       value="{!! $item->answer_4 !!}">
                                                @if(isset($wrong["{$item->id}"]) && $answer["{$item->id}"] == $wrong["{$item->id}"] && $answer["{$item->id}"] == $item->answer_4 )
                                                    <span style="color:red;"><i class="fa fa-times" aria-hidden="true"></i> {!! $item->answer_4 !!}</span>
                                                @else
                                                    {!! $item->answer_4 !!}
                                                @endif
                                            </label><br>
                                        </div>

                                    @endforeach

                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection