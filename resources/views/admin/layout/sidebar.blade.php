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
        @can('admin-pms', 'admin.account.getList')
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
                        @can('admin-pms', 'admin.account.getCreate')
                            <li class="nav-item">
                                <a class="nav-link @if(in_array($currentRoute,['admin.account.getCreate'])) active @endif" href="{{ route('admin.account.getCreate') }}">Tạo tài khoản mới</a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcan
        @can('admin-pms', 'admin.permission.getList')
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
                        @can('admin-pms', 'admin.permission.getCreate')
                            <li class="nav-item">
                                <a class="nav-link @if(in_array($currentRoute,['admin.permission.getCreate'])) active @endif" href="{{ route('admin.permission.getCreate') }}">Tạo nhóm quyền mới</a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcan


    </ul>
</nav>