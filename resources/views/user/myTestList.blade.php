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
                                <form method="GET" action="user/myTestList" class="form-s fl-left">
                                    <select name="select_lesson">
                                        <option value="">--Chọn bài học--</option>
                                        @foreach($lesson as $item)
                                            <option @if($select_lesson == $item->id){{"selected"}} @endif value="{!! $item->id !!}">{!! $item ->lesson_name !!}</option>
                                        @endforeach
                                    </select>
                                    <input type="date" name="date" placeholder="yyyy-mm-dd">
                                    <input type="submit" name="sm_s" value="Tìm kiếm">
                                </form>

                            </div>
                            <div class="table-responsive">
                                <table class="table list-table-wp table-bordered">
                                    <thead>
                                    <tr>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Tên bài học</span></td>
                                        <td><span class="thead-text">Số điểm</span></td>
                                        <td><span class="thead-text">Thời gian làm</span></td>
                                        <td><span class="thead-text">Làm lại</span></td>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if(!empty($test_list))
                                        <?php $num_order = 0; ?>
                                        @foreach($test_list as $item)
                                            <?php $num_order += 1; ?>
                                            <tr>
                                                <td><span class="tbody-text">{!! $num_order !!}</span></td>
                                                <td><span class="tbody-text">
                                                <a href="user/myTestDetail/{!! $item->id !!}.html">
                                                    <?php $lesson = DB::table('lesson')->where('id', $item->lesson_id)->first();?>
                                                    @if(!empty($lesson))
                                                        {!! $lesson->lesson_name !!}
                                                    @endif
                                                </a>
                                                     </span>
                                                </td>
                                                <td><span class="tbody-text">{!! $item -> score !!}</span></td>
                                                <td><span class="tbody-text">{!! $item -> created_at !!}</span></td>
                                                <td><span class="tbody-text "></span>
                                                    <a href=""
                                                       title="Làm lại"><i
                                                                class="fa fa-refresh" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4"><p>Chưa có bài luyện tập nào</p></td>
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
