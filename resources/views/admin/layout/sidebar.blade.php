<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        {{--<li class="nav-item nav-profile">--}}
            {{--<div class="nav-link">--}}
                {{--<div class="user-wrapper">--}}
                    {{--<div class="profile-image">--}}
                        {{--<img src="images/faces/face1.jpg" alt="profile image">--}}
                    {{--</div>--}}
                    {{--<div class="text-wrapper">--}}
                        {{--<p class="profile-name">Richard V.Welsh</p>--}}
                        {{--<div>--}}
                            {{--<small class="designation text-muted">Manager</small>--}}
                            {{--<span class="status-indicator online"></span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<button class="btn btn-success btn-block">New Project--}}
                    {{--<i class="mdi mdi-plus"></i>--}}
                {{--</button>--}}
            {{--</div>--}}
        {{--</li>--}}
        <li class="nav-item @if(in_array($currentRoute,['admin.home.dashboard'])) active @endif">
            <a class="nav-link" href="{{ route('admin.home.dashboard') }}">
                <i class="menu-icon mdi mdi-television"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if(auth('admin')->user()->can('admin-pms', 'admin.account.getList'))
            <li class="nav-item @if(in_array($currentRoute,['admin.account.getList', 'admin.account.getCreate'])) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-account"></i>
                    <span class="menu-title">Quản lý tài khoản</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse @if(in_array($currentRoute,['admin.account.getList', 'admin.account.getCreate'])) show @endif" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link @if(in_array($currentRoute,['admin.account.getList'])) active @endif" href="{{ route('admin.account.getList') }}">Danh sách tài khoản</a>
                        </li>
                        @if(auth('admin')->user()->can('admin-pms', 'admin.account.getCreate'))
                            <li class="nav-item">
                                <a class="nav-link @if(in_array($currentRoute,['admin.account.getCreate'])) active @endif" href="{{ route('admin.account.getCreate') }}">Tạo tài khoản mới</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
        @endif
        @if(auth('admin')->user()->can('admin-pms', 'admin.permission.getList'))
            <li class="nav-item @if(in_array($currentRoute,['admin.permission.getList', 'admin.permission.getCreate'])) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-alert"></i>
                    <span class="menu-title">Quản lý nhóm quyền</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse @if(in_array($currentRoute,['admin.permission.getList', 'admin.permission.getCreate'])) show @endif" id="ui-basic2">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link @if(in_array($currentRoute,['admin.permission.getList'])) active @endif" href="{{ route('admin.permission.getList') }}">Danh sách nhóm quyền</a>
                        </li>
                        @if(auth('admin')->user()->can('admin-pms', 'admin.permission.getCreate'))
                            <li class="nav-item">
                                <a class="nav-link @if(in_array($currentRoute,['admin.permission.getCreate'])) active @endif" href="{{ route('admin.permission.getCreate') }}">Tạo nhóm quyền mới</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
        @endif
        @if(auth('admin')->user()->can('admin-pms', 'admin.category.getList'))
            <li class="nav-item @if(in_array($currentRoute,['admin.category.getList'])) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-view-list"></i>
                    <span class="menu-title">Quản lý danh mục</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse @if(in_array($currentRoute,['admin.category.getList'])) show @endif" id="ui-basic3">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link @if(in_array($currentRoute,['admin.category.getList'])) active @endif" href="{{ route('admin.category.getList') }}">Danh sách danh mục</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif
        @if(auth('admin')->user()->can('admin-pms', 'admin.province.getList'))
            <li class="nav-item @if(in_array($currentRoute,['admin.province.getList'])) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-map-marker-radius"></i>
                    <span class="menu-title">Quản lý tỉnh thành</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse @if(in_array($currentRoute,['admin.province.getList', 'admin.district.getList', 'admin.ward.getList'])) show @endif" id="ui-basic4">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link @if(in_array($currentRoute,['admin.province.getList'])) active @endif" href="{{ route('admin.province.getList') }}">Danh sách tỉnh thành</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(in_array($currentRoute,['admin.district.getList'])) active @endif" href="{{ route('admin.district.getList') }}">Danh sách quận huyện</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(in_array($currentRoute,['admin.ward.getList'])) active @endif" href="{{ route('admin.ward.getList') }}">Danh sách phường xã</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif
        @if(auth('admin')->user()->can('admin-pms', 'admin.file.getList'))
            <li class="nav-item @if(in_array($currentRoute,['admin.file.getList'])) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic10" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-folder-multiple-image"></i>
                    <span class="menu-title">Quản lý Media Library</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse @if(in_array($currentRoute,['admin.file.getList'])) show @endif" id="ui-basic10">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link @if(in_array($currentRoute,['admin.file.getList'])) active @endif" href="{{ route('admin.file.getList') }}">Media library</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif
        @if(auth('admin')->user()->can('admin-pms', 'admin.article.getList'))
            <li class="nav-item @if(in_array($currentRoute,['admin.article.getList'])) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic5" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-book-multiple"></i>
                    <span class="menu-title">Quản lý Bài viết</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse @if(in_array($currentRoute,['admin.article.getList','admin.article.getCreate'])) show @endif" id="ui-basic5">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link @if(in_array($currentRoute,['admin.article.getList'])) active @endif" href="{{ route('admin.article.getList') }}">Danh sách bài viết</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(in_array($currentRoute,['admin.article.getCreate'])) active @endif" href="{{ route('admin.article.getCreate') }}">Tạo bài viết mới</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif
        @if(auth('admin')->user()->can('admin-pms', 'admin.law.getList'))
            <li class="nav-item @if(in_array($currentRoute,['admin.law.getList'])) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic6" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-book-multiple"></i>
                    <span class="menu-title">Quản lý Luật</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse @if(in_array($currentRoute,['admin.law.getList','admin.law.getCreate'])) show @endif" id="ui-basic6">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link @if(in_array($currentRoute,['admin.law.getList'])) active @endif" href="{{ route('admin.law.getList') }}">Danh sách bài viết</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(in_array($currentRoute,['admin.law.getCreate'])) active @endif" href="{{ route('admin.law.getCreate') }}">Tạo bài viết mới</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif
        @if(auth('admin')->user()->can('admin-pms', 'admin.project.getList'))
            <li class="nav-item @if(in_array($currentRoute,['admin.project.getList'])) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic7" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-book-multiple"></i>
                    <span class="menu-title">Quản lý Dự Án</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse @if(in_array($currentRoute,['admin.project.getList','admin.project.getCreate'])) show @endif" id="ui-basic7">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link @if(in_array($currentRoute,['admin.project.getList'])) active @endif" href="{{ route('admin.project.getList') }}">Danh sách bài viết</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(in_array($currentRoute,['admin.project.getCreate'])) active @endif" href="{{ route('admin.project.getCreate') }}">Tạo bài viết mới</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif
        @if(auth('admin')->user()->can('admin-pms', 'admin.room.getList'))
            <li class="nav-item @if(in_array($currentRoute,['admin.room.getList','admin.room.getCreate'])) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic8" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-home-variant"></i>
                    <span class="menu-title">Quản lý phòng trọ</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse @if(in_array($currentRoute,['admin.room.getList','admin.room.getCreate'])) show @endif" id="ui-basic8">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link @if(in_array($currentRoute,['admin.room.getList'])) active @endif" href="{{ route('admin.room.getList') }}">Danh sách phòng trọ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(in_array($currentRoute,['admin.room.getCreate'])) active @endif" href="{{ route('admin.room.getCreate') }}">Tạo bài phòng trọ</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif
        @if(auth('admin')->user()->can('admin-pms', 'admin.advertise.getList'))
            <li class="nav-item @if(in_array($currentRoute,['admin.advertise.getList','admin.advertise.getCreate'])) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic9" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-home-variant"></i>
                    <span class="menu-title">Quản lý quảng cáo</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse @if(in_array($currentRoute,['admin.advertise.getList','admin.advertise.getCreate'])) show @endif" id="ui-basic9">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link @if(in_array($currentRoute,['admin.advertise.getList'])) active @endif" href="{{ route('admin.advertise.getList') }}">Danh sách quảng cáo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(in_array($currentRoute,['admin.advertise.getCreate'])) active @endif" href="{{ route('admin.advertise.getCreate') }}">Tạo quảng cáo</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif


    </ul>
</nav>