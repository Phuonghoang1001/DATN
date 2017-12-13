<div class="col-md-3">
    <div class="side-bar">
        <ul>
            <h4 class="side-bar-title">Khóa học</h4>
            @foreach($lesson as $item)
            <li class="side-bar-item"><a href="lesson/{!! $item->id !!}.html">{{$item->lesson_name}}</a></li>
            @endforeach
        </ul>
    </div>
</div>