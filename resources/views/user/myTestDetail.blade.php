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
                            <h3 id="index" class="text-center text-uppercase">Bài kiểm tra của bạn</h3>
                        </div>
                    </div>
                    <div class="section" id="detail-page">
                        @if(session('err'))
                            <div class="alert alert-danger">
                                {{session('err')}}
                            </div>
                        @endif

                        @if(session('msg'))
                            <div class="alert alert-success">
                                {{session('msg')}}
                            </div>
                        @endif
                        <div class="section-detail">
                            <div class="filter-wp clearfix">

                            </div>
                            <div class="table-responsive">
                                <table class="table list-table-wp table-bordered">
                                    <thead>
                                    <tr>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Bài kiểm tra</span></td>
                                        <td><span class="thead-text">Câu hỏi</span></td>
                                        <td><span class="thead-text">Câu trả lời của bạn</span></td>
                                        <td><span class="thead-text">Đáp án đúng</span></td>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if(!empty($test_detail))
                                        <?php $num_order = 0; ?>
                                        @foreach($test_detail as $item)
                                            <?php $num_order += 1; ?>
                                            <tr>
                                                <td><span class="tbody-text">{!! $num_order !!}</span></td>
                                                <td><span class="tbody-text">
                                                    <?php $test = DB::table('user_test')->where('id', $item->user_test_id)->first();?>
                                                        @if(!empty($test))
                                                            {!!   $test->id !!}
                                                        @endif
                                                </span>
                                                </td>
                                                <td><span class="tbody-text">
                                                         <?php $question = DB::table('question_test')->where('id', $item->test_id)->first();?>
                                                        @if(!empty($question))
                                                            {!! $question -> test_content !!}
                                                        @endif
                                                    </span></td>
                                                <td><span class="tbody-text">{!! $item -> my_answer !!}</span></td>
                                                <td><span class="tbody-text "></span>
                                                    {!! $item->right_answer !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5"><p>Chưa có bài luyện tập nào</p></td>
                                        </tr>
                                    @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
