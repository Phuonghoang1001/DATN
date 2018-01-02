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
                            <h3 id="index" class="text-center text-uppercase">Các bài học theo dõi</h3>
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
                                        <td><span class="thead-text">Tên bài học</span></td>
                                        <td><span class="thead-text">Bỏ theo dõi</span></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        @if(!empty($followed))
                                            <?php $num_order = 0; ?>
                                            @foreach($followed as $item)
                                                <?php $num_order += 1; ?>
                                                <td><span class="tbody-text">{!! $num_order !!}</span></td>
                                                <td><span class="tbody-text">
                                                <a href="lesson/{!! $item->lesson_id !!}.html">
                                                    <?php $lesson = DB::table('lesson')->where('id', $item->lesson_id)->first();?>
                                                    @if(!empty($lesson))
                                                        {!! $lesson->lesson_name !!}
                                                    @endif
                                                </a>
                                                </span>
                                                </td>
                                                <td><span class="tbody-text "></span>
                                                    <a href="user/lesson_follow_delete/{!! $item->id !!}"
                                                       title="Bỏ theo dõi"><i
                                                                class="fa fa-trash" aria-hidden="true"></i></a>
                                                </td>
                                            @endforeach
                                        @else
                                            <td colspan="4"><p>Không theo dõi bài học nào</p></td>
                                        @endif
                                    </tr>
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
