<div id="header-wp">
    <div class="wp-inner clearfix">

        <a href="?page=list_post" title="" id="logo" class="fl-left">Trang Admin</a>
            <div id="dropdown-user" class="dropdown dropdown-extended fl-right">
                <button class="dropdown-toggle clearfix" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="true">
                    <h3 id="account" class="fl-right"><i class="fa fa-user"></i> <i class="fa fa-caret-down"></i></h3>
                </button>
                <ul class="dropdown-menu">
                    @if(Auth::check())
                    <li><a><i class="fa fa-user"></i> {!! Auth::user()->name !!}</a></li>
                    <li><a href="admin/user/edit/{!!  Auth::user()->id !!}" title="Thông tin cá nhân"><i class="fa fa-edit"></i>
                            Chỉnh sửa</a></li>
                    <li><a href="admin/logout" title="Thoát"><i class="fa fa-sign-out"></i> Đăng xuất</a></li>
                    @endif
                </ul>
            </div>
    </div>
</div>