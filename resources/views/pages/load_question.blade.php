@if(!empty($question_test))
    <form action="test/{{$lesson_item->id}}.html" id="form-answer" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="level" value="{{$level}}">
        <?php $num = 0; ?>
        @foreach($question_test as $item)
            <?php $num++; ?>
            <div class="question-item">
                <b>Câu {!! $num !!} : </b>
                <span>{!! $item->test_content !!}</span> <br>
                <label>
                    <input type="radio" name="answer_{!! $item->id !!}"
                           value="{!! $item->answer_1 !!}"> {!! $item->answer_1 !!}
                </label>
                <label>
                    <input type="radio" name="answer_{!! $item->id !!}"
                           value="{!! $item->answer_2 !!}"> {!! $item->answer_2 !!}
                </label>
                <label>
                    <input type="radio" name="answer_{!! $item->id !!}"
                           value="{!! $item->answer_3 !!}">{!! $item->answer_3!!}
                </label>
                <label>
                    <input type="radio" name="answer_{!! $item->id !!}"
                           value="{!! $item->answer_4 !!}">{!! $item->answer_4 !!}
                </label><br>
            </div>
        @endforeach
        <input type="hidden" name="num_question" id="num_question" value="{!! $num !!}">
        <button type="submit" class="btn-answer">Kiểm tra</button>
    </form>
@endif
