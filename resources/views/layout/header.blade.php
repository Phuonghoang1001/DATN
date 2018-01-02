<header class="header">
    <div class="container">
        <nav class="navbar nav-main">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="home"><img src="images/BCEnglish.png" alt=""></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse main-menu" id="bs-example-navbar-collapse-1 ">
                    <ul class="nav navbar-nav pull-right">
                        <li>
                            <form method="GET" action="" class="form-s fl-left">
                                <input type="text" name="search" placeholder="Tìm kiếm" value="{!! $search !!}">
                                <button type="submit" name="sm_s" ><i class="fa fa-search"></i></button>
                            </form>
                        </li>
                        @if(Auth::check())
                            <li><a href="user/myAccount"><i class="fa fa-user"></i> {!! Auth::user()->name !!}</a></li>
                            <li><a href="logout">Đăng xuất</a></li>
                        @else
                            <li><a href="login">Đăng nhập</a></li>
                            <li><a href="register">Đăng Ký</a></li>
                        @endif

                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>
</header>