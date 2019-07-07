<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link @if(in_array($currentRoute,['admin.home.dashboard'])) active @endif"
                    href="{{ route('admin.home.dashboard') }}">
                    <i class="nav-icon icon-speedometer"></i> Dashboard
                    {{-- <span class="badge badge-primary">NEW</span> --}}
                </a>
            </li>
            <li class="nav-title">Tài khoản</li>
            @if(auth('admin')->user()->can('admin-pms', 'admin.account.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.account.getList', 'admin.account.getCreate'])) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-user"></i>Tài khoản</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.account.getList'])) active @endif" href="{{ route('admin.account.getList') }}">
                            <i class="nav-icon "></i> Danh sách</a>
                    </li>
                    @if(auth('admin')->user()->can('admin-pms', 'admin.account.getCreate'))
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.account.getCreate'])) active @endif" href="{{ route('admin.account.getCreate') }}">
                            <i class="nav-icon "></i> Thêm mới</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if(auth('admin')->user()->can('admin-pms', 'admin.permission.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.permission.getList', 'admin.permission.getCreate'])) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-key"></i> Phân quyền</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.permission.getList'])) active @endif" href="{{ route('admin.permission.getList') }}">
                            <i class="nav-icon "></i> Danh sách</a>
                    </li>
                    @if(auth('admin')->user()->can('admin-pms', 'admin.permission.getCreate'))
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.permission.getCreate'])) active @endif" href="{{ route('admin.permission.getCreate') }}">
                            <i class="nav-icon "></i> Thêm mới</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            <li class="nav-title">Nội dung</li>
            @if(auth('admin')->user()->can('admin-pms', 'admin.category.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.category.getList'])) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-list"></i>Danh mục</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.category.getList'])) active @endif" href="{{ route('admin.category.getList') }}">
                            <i class="nav-icon "></i> Danh sách</a>
                    </li>
                </ul>
            </li>
            @endif
            @if(auth('admin')->user()->can('admin-pms', 'admin.file.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.file.getList'])) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-picture"></i>Media</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.file.getList'])) active @endif" href="{{ route('admin.file.getList') }}">
                            <i class="nav-icon "></i> Danh sách</a>
                    </li>
                </ul>
            </li>
            @endif
            @if(auth('admin')->user()->can('admin-pms', 'admin.article.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.article.getList','admin.article.getCreate'])) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-book-open"></i>Bài viết</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.article.getList'])) active @endif" href="{{ route('admin.article.getList') }}">
                            <i class="nav-icon "></i> Danh sách</a>
                    </li>
                    @if(auth('admin')->user()->can('admin-pms', 'admin.article.getCreate'))
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.article.getCreate'])) active @endif" href="{{ route('admin.article.getCreate') }}">
                            <i class="nav-icon "></i> Thêm mới</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if(auth('admin')->user()->can('admin-pms', 'admin.product.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.product.getList','admin.product.getCreate'])) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-trophy"></i>Sản phẩm</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.product.getList'])) active @endif" href="{{ route('admin.product.getList') }}">
                            <i class="nav-icon "></i> Danh sách</a>
                    </li>
                    @if(auth('admin')->user()->can('admin-pms', 'admin.product.getCreate'))
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.product.getCreate'])) active @endif" href="{{ route('admin.product.getCreate') }}">
                            <i class="nav-icon "></i> Thêm mới</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if(auth('admin')->user()->can('admin-pms', 'admin.order.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.order.getList'])) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-present"></i>Đơn hàng</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.order.getList'])) active @endif" href="{{ route('admin.order.getList') }}">
                            <i class="nav-icon "></i> Danh sách</a>
                    </li>
                </ul>
            </li>
            @endif
            @if(auth('admin')->user()->can('admin-pms', 'admin.user.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.user.getList'])) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-people"></i>Khách hàng</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.user.getList'])) active @endif" href="{{ route('admin.user.getList') }}">
                            <i class="nav-icon "></i> Danh sách</a>
                    </li>
                </ul>
            </li>
            @endif
            {{-- @if(auth('admin')->user()->can('admin-pms', 'admin.user.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.material.getList'])) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-people"></i>Loại vật liệu</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.material.getList'])) active @endif" href="{{ route('admin.material.getList') }}">
                            <i class="nav-icon "></i> Danh sách</a>
                    </li>
                    @if(auth('admin')->user()->can('admin-pms', 'admin.material.getCreate'))
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.material.getCreate'])) active @endif" href="{{ route('admin.material.getCreate') }}">
                            <i class="nav-icon "></i> Thêm mới</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif --}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
