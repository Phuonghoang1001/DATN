@extends('layout.index')
@section('content')
    <div class="container">
        <section class="lesson-wrapper">
            <div class="row">
                @include('layout.sidebar')
                <div class="col-md-9">
                    <div class="lesson-single">
                        <div class="lesson-header">
                            <h2 class="lesson-title">{{$lesson_item->lesson_name}}</h2>
                            <div class="header__line"></div>
                        </div>
                        <div class="inner clearfix">
                            <p>{!! $lesson_item->lesson_content !!}</p>
                            <div class="tab">
                                @foreach($lesson_detail as $item)
                                    <button class="tablinks lesson-detail-title"
                                            onclick="openTab(event, '{!!$item->detail_name !!}')">{!!$item->detail_name !!}</button>
                                @endforeach
                            </div>

                            @foreach($lesson_detail as $item)
                                <div id="{!!$item->detail_name !!}" class="tabcontent lesson-detail">
                                    <div class="lesson-detail-item">
                                        <div class="lesson-detail-content">{!! $item->detail_content !!}</div>
                                    </div>
                                </div>
                            @endforeach
                            @if(Auth::check())
                                <div class="user-actions text-right">
                                    <button data-href="
                                    @if(checkKey($followed,'user_id',Auth::user()->id) &&
                                                checkKey($followed, 'lesson_id', $lesson_item ->id)) user/lesson_followed_delete/{!! $lesson_item->id !!}
                                    @else user/lesson_followed_add/{!! $lesson_item->id !!} @endif"
                                            class="btn-pin user-pin" data-toggle="tooltip"
                                            data-placement="top" data-lesson="{!! $lesson_item->id !!}"
                                            data-original-title="
                                            @if(checkKey($followed,'user_id',Auth::user()->id) &&
                                                checkKey($followed, 'lesson_id', $lesson_item ->id))
                                                    Bỏ lưu bài học @else Lưu bài học để xem tiếp @endif " id="user-pin">
                                        <i class="fa
                                            @if(checkKey($followed,'user_id',Auth::user()->id) &&
                                                checkKey($followed, 'lesson_id', $lesson_item ->id))
                                                fa-bookmark @else fa-bookmark-o @endif "
                                           aria-hidden="true">
                                        </i>
                                    </button>
                                    <button data-href="@if(checkKey($favourite,'user_id',Auth::user()->id) &&
                                                checkKey($favourite, 'lesson_id', $lesson_item ->id)) user/lesson_favourite_delete/{!! $lesson_item->id !!}
                                    @else user/lesson_favourite_add/{!! $lesson_item->id !!} @endif"
                                            class="btn-favourite user-favourite" data-toggle="tooltip"
                                            data-placement="top" data-lesson="{!! $lesson_item->id !!}"
                                            data-original-title="
                                            @if(checkKey($favourite,'user_id',Auth::user()->id) &&
                                                checkKey($favourite, 'lesson_id', $lesson_item ->id))
                                                    Bỏ thích @else Lưu bài học vào mục yêu thích @endif "
                                            id="user-favourite">
                                        <i class="fa
                                            @if(checkKey($favourite,'user_id',Auth::user()->id) &&
                                                checkKey($favourite, 'lesson_id', $lesson_item ->id))
                                                fa-heart @else fa-heart-o @endif "
                                           aria-hidden="true">
                                        </i>
                                    </button>
                                    <a href="test/{!! $lesson_item->id !!}.html" class="btn-test user-test"
                                       data-toggle="tooltip" data-placement="top"
                                       title="Làm bài test">
                                        <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                                    </a>
                                </div>
                            @else
                                <div class="user-actions text-right">
                                    <button data-href="user/lesson_followed_add/{!! $lesson_item->id !!}"
                                            class="btn-pin user-pin" data-toggle="tooltip"
                                            data-placement="top" data-lesson="{!! $lesson_item->id !!}"
                                            data-original-title="Lưu bài học để xem tiếp" id="user-pin" disabled>
                                        <i class="fa fa-bookmark-o"
                                           aria-hidden="true">
                                        </i>
                                    </button>
                                    <button data-href="user/lesson_favourite_add/{!! $lesson_item->id !!}"
                                            class="btn-favourite user-favourite" data-toggle="tooltip"
                                            data-placement="top" data-lesson="{!! $lesson_item->id !!}"
                                            data-original-title="Lưu bài học vào mục yêu thích" id="user-favourite"
                                            disabled>
                                        <i class="fa fa-heart-o"
                                           aria-hidden="true">
                                        </i>
                                    </button>
                                    <a href="test/{!! $lesson_item->id !!}.html" class="btn-test user-test"
                                       data-toggle="tooltip" data-placement="top"
                                       title="Làm bài test">
                                        <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                                    </a>
                                </div>
                            @endif
                            <hr>
                            <div class="user-comment">
                                <h4 class="user-comment__title">Câu hỏi thắc mắc</h4>
                                <div class="user-comment__content">
                                    @if(Auth::check())
                                        <form class="form-comment" action="comment/{!! $lesson_item->id !!}.html"
                                              method="POST"
                                              enctype="multipart/form-data" id="form-comment">
                                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                            <div class="input-group">
                                                <input type="text" name="comment" id="comment" class="form-control"
                                                       placeholder="Nhập câu hỏi của bạn">
                                                <span class="input-group-btn">
                                                     <button class="btn btn-secondary btn-comment" name="btn-comment"
                                                             type="submit"><i class="fa fa-paper-plane"></i></button>
                                                </span>
                                            </div>
                                        </form>
                                    @else
                                        <p><a href="login">Đăng nhập </a> để đặt câu hỏi với chúng tôi. </p>
                                    @endif

                                </div>
                                <hr>
                                <div class="list-comment">
                                    <ul>
                                        {{--Đổ comment--}}
                                        @if(!empty($question_comment))
                                            @foreach($question_comment as $item)
                                                <li class="item-comment clearfix"
                                                    @if($item->parent_id != 0) style="padding-left: 90px;" @endif>
                                                    <?php $user = DB::table('users')->where('id', $item->user_id)->first()?>
                                                    @if(empty($user->image))
                                                    <div class="user-img pull-left">
                                                        <img src="images/unknown-user.png">
                                                    </div>
                                                        @else
                                                            <div class="user-img pull-left">
                                                                <img src="upload/image/{!! $user->image !!}">
                                                            </div>
                                                        @endif
                                                    <div class="user-info pull-left">
                                                        <p>
                                                            {{--hiển thị người comment--}}
                                                            <span class="user-name">
                                                                @if(!empty($user))
                                                                    {!! $user->name !!}
                                                                @endif
                                                        </span>
                                                            <span class="published">{!! $item -> created_at !!}</span>
                                                        </p>
                                                        <p class="comment-content">{!! $item->content !!}</p>
                                                        @if($item->parent_id == 0)
                                                            <button class="reply" id="reply_{!! $item->id !!}">Trả lời</button>
                                                        @endif
                                                        @if($item->user_id ==Auth::user()->id)
                                                        <a href="delete_comment/{!! $item->id !!}"
                                                           data-confirm ="Bạn có chắc chắn muốn xóa ?"
                                                           class="delete-comment"  >Xóa</a>
                                                        @endif
                                                        <button class="edit-comment " @if($item->user_id !=Auth::user()->id) disabled data-toggle="tooltip"
                                                                data-placement="top"
                                                                title=" Không được phép chỉnh sửa bình luận này" @endif>Chỉnh sửa</button>
                                                        {{--form chỉnh sửa bình luận--}}
                                                        <form action="edit_comment/{!! $item->id !!}" class="form-edit"
                                                              method="POST">
                                                            <input type="hidden" name="_token"
                                                                   value="{!! csrf_token() !!}">
                                                            <div class="input-group">
                                                                <input type="text" name="comment_edit" id="comment"
                                                                       class="form-control"
                                                                       value="{!! $item->content !!}">
                                                                <span class="input-group-btn">
                                                                        <button class="btn btn-secondary btn-comment"
                                                                                name="btn-comment"
                                                                                type="submit"><i
                                                                                    class="fa fa-paper-plane"></i></button>
                                                                    </span>
                                                            </div>
                                                        </form>
                                                        {{--form trả lời bình luận--}}
                                                        <form action="reply/{!! $item->id !!}" method="POST"
                                                               class="form-reply form-comment" id="form_{!! $item->id !!}">
                                                            <input type="hidden" name="_token"
                                                                   value="{!! csrf_token() !!}">
                                                            <input type="hidden" name="parent"
                                                                   value="{!! $item->id !!}">
                                                            <div class="input-group">
                                                                <input type="text" name="comment" id="comment"
                                                                       class="form-control"
                                                                       placeholder="Trả lời">
                                                                <span class="input-group-btn">
                                                                        <button class="btn btn-secondary btn-comment"
                                                                                name="btn-comment"
                                                                                type="submit"><i
                                                                                    class="fa fa-paper-plane"></i></button>
                                                                    </span>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection