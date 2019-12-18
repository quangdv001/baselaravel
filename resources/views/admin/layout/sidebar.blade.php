<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link @if(in_array($currentRoute,['admin.home.dashboard'])) active @endif"
                    href="index.html">
                    <i class="nav-icon icon-speedometer"></i> Dashboard
                    {{-- <span class="badge badge-primary">NEW</span> --}}
                </a>
            </li>
            <li class="nav-title">Tài khoản</li>
            @if(auth('admin')->user()->can('admin-pms', 'admin.account.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.account.getList', 'admin.account.getCreate'])) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0);">
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
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0);">
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
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0);">
                    <i class="nav-icon icon-list"></i>Danh mục</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.category.getList'])) active @endif" href="{{ route('admin.category.getList') }}">
                            <i class="nav-icon "></i> Danh sách</a>
                    </li>
                </ul>
            </li>
            @endif
            @if(auth('admin')->user()->can('admin-pms', 'admin.province.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.province.getList', 'admin.district.getList', 'admin.ward.getList'])) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-location-pin"></i>Tỉnh thành</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.province.getList'])) active @endif" href="{{ route('admin.province.getList') }}">
                            <i class="nav-icon "></i> Tỉnh/Thành</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.district.getList'])) active @endif" href="{{ route('admin.district.getList') }}">
                            <i class="nav-icon "></i> Quận/Huyện</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.ward.getList'])) active @endif" href="{{ route('admin.ward.getList') }}">
                            <i class="nav-icon "></i> Phường/Xã</a>
                    </li>
                </ul>
            </li>
            @endif
            @if(auth('admin')->user()->can('admin-pms', 'admin.file.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.file.getList'])) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0);">
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
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.article.getList','admin.article.getCreate']) && $currentParams['type'] == 1) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0);">
                    <i class="nav-icon icon-layers"></i>Nhà đất</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.article.getList']) && $currentParams['type'] == 1) active @endif" href="{{ route('admin.article.getList', 1) }}">
                            <i class="nav-icon "></i> Danh sách</a>
                    </li>
                    @if(auth('admin')->user()->can('admin-pms', 'admin.article.getCreate'))
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.article.getCreate']) && $currentParams['type'] == 1) active @endif" href="{{ route('admin.article.getCreate', ['type' => 1]) }}">
                            <i class="nav-icon "></i> Thêm mới</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if(auth('admin')->user()->can('admin-pms', 'admin.article.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.article.getList','admin.article.getCreate']) && $currentParams['type'] == 2) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0);">
                    <i class="nav-icon icon-people"></i>Sàn giao dịch</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.article.getList']) && $currentParams['type'] == 2) active @endif" href="{{ route('admin.article.getList', 2) }}">
                            <i class="nav-icon "></i> Danh sách</a>
                    </li>
                    @if(auth('admin')->user()->can('admin-pms', 'admin.article.getCreate'))
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.article.getCreate']) && $currentParams['type'] == 2) active @endif" href="{{ route('admin.article.getCreate', ['type' => 2]) }}">
                            <i class="nav-icon "></i> Thêm mới</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if(auth('admin')->user()->can('admin-pms', 'admin.article.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.article.getList','admin.article.getCreate']) && $currentParams['type'] == 3) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0);">
                    <i class="nav-icon icon-plane"></i>Đô thị</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.article.getList']) && $currentParams['type'] == 3) active @endif" href="{{ route('admin.article.getList', 3) }}">
                            <i class="nav-icon "></i> Danh sách</a>
                    </li>
                    @if(auth('admin')->user()->can('admin-pms', 'admin.article.getCreate'))
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.article.getCreate']) && $currentParams['type'] == 3) active @endif" href="{{ route('admin.article.getCreate', ['type' => 3]) }}">
                            <i class="nav-icon "></i> Thêm mới</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if(auth('admin')->user()->can('admin-pms', 'admin.article.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.article.getList','admin.article.getCreate']) && $currentParams['type'] == 4) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0);">
                    <i class="nav-icon icon-book-open"></i>Tin tức</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.article.getList']) && $currentParams['type'] == 4) active @endif" href="{{ route('admin.article.getList', 4) }}">
                            <i class="nav-icon "></i> Danh sách</a>
                    </li>
                    @if(auth('admin')->user()->can('admin-pms', 'admin.article.getCreate'))
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.article.getCreate']) && $currentParams['type'] == 4) active @endif" href="{{ route('admin.article.getCreate', ['type' => 4]) }}">
                            <i class="nav-icon "></i> Thêm mới</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if(auth('admin')->user()->can('admin-pms', 'admin.article.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.article.getList','admin.article.getCreate']) && $currentParams['type'] == 5) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0);">
                    <i class="nav-icon icon-notebook"></i>Pháp lý</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.article.getList']) && $currentParams['type'] == 5) active @endif" href="{{ route('admin.article.getList', 5) }}">
                            <i class="nav-icon "></i> Danh sách</a>
                    </li>
                    @if(auth('admin')->user()->can('admin-pms', 'admin.article.getCreate'))
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.article.getCreate']) && $currentParams['type'] == 5) active @endif" href="{{ route('admin.article.getCreate', ['type' => 5]) }}">
                            <i class="nav-icon "></i> Thêm mới</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if(auth('admin')->user()->can('admin-pms', 'admin.room.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.room.getList','admin.room.getCreate'])) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0);">
                    <i class="nav-icon icon-home"></i>Cho thuê</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.room.getList'])) active @endif" href="{{ route('admin.room.getList') }}">
                            <i class="nav-icon "></i> Danh sách</a>
                    </li>
                    @if(auth('admin')->user()->can('admin-pms', 'admin.room.getCreate'))
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.room.getCreate'])) active @endif" href="{{ route('admin.room.getCreate') }}">
                            <i class="nav-icon "></i> Thêm mới</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @if(auth('admin')->user()->can('admin-pms', 'admin.article.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.page.getList','admin.page.getCreate'])) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0);">
                    <i class="nav-icon icon-docs"></i>Trang nội dung</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.page.getList'])) active @endif" href="{{ route('admin.page.getList') }}">
                            <i class="nav-icon "></i> Danh sách</a>
                    </li>
                    @if(auth('admin')->user()->can('admin-pms', 'admin.page.getCreate'))
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.page.getCreate'])) active @endif" href="{{ route('admin.page.getCreate') }}">
                            <i class="nav-icon "></i> Thêm mới</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @if(auth('admin')->user()->can('admin-pms', 'admin.article.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.article.getList','admin.article.getCreate']) && $currentParams['type'] == 8) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0);">
                    <i class="nav-icon icon-notebook"></i>Cách tính thuế đất</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.article.getList']) && $currentParams['type'] == 8) active @endif" href="{{ route('admin.article.getList', 8) }}">
                            <i class="nav-icon "></i> Danh sách</a>
                    </li>
                    @if(auth('admin')->user()->can('admin-pms', 'admin.article.getCreate'))
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.article.getCreate']) && $currentParams['type'] == 8) active @endif" href="{{ route('admin.article.getCreate', ['type' => 8]) }}">
                            <i class="nav-icon "></i> Thêm mới</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @if(auth('admin')->user()->can('admin-pms', 'admin.article.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.article.getList','admin.article.getCreate']) && $currentParams['type'] == 9) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0);">
                    <i class="nav-icon icon-notebook"></i>Quản lý đối tác</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.article.getList']) && $currentParams['type'] == 9) active @endif" href="{{ route('admin.article.getList', 9) }}">
                            <i class="nav-icon "></i> Danh sách</a>
                    </li>
                    @if(auth('admin')->user()->can('admin-pms', 'admin.article.getCreate'))
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.article.getCreate']) && $currentParams['type'] == 9) active @endif" href="{{ route('admin.article.getCreate', ['type' => 9]) }}">
                            <i class="nav-icon "></i> Thêm mới</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @if(auth('admin')->user()->can('admin-pms', 'admin.advertise.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.advertise.getList','admin.advertise.getCreate'])) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0);">
                    <i class="nav-icon icon-docs"></i>Quản lý quảng cáo</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.advertise.getList'])) active @endif" href="{{ route('admin.advertise.getList') }}">
                            <i class="nav-icon "></i> Danh sách quảng cáo</a>
                    </li>
                    @if(auth('admin')->user()->can('admin-pms', 'admin.advertise.getCreate'))
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.advertise.getCreate'])) active @endif" href="{{ route('admin.advertise.getCreate') }}">
                            <i class="nav-icon "></i> Thêm mới quảng cáo</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if(auth('admin')->user()->can('admin-pms', 'admin.generalInfo.index'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.generalInfo.index','admin.generalInfo.getCreate'])) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0);">
                    <i class="nav-icon icon-docs"></i>Quản lý Cấu hình</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.generalInfo.index'])) active @endif" href="{{ route('admin.generalInfo.index') }}">
                            <i class="nav-icon "></i> Danh sách Cấu hình</a>
                    </li>
                    @if(auth('admin')->user()->can('admin-pms', 'admin.generalInfo.getCreate'))
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.generalInfo.getCreate'])) active @endif" href="{{ route('admin.generalInfo.getCreate') }}">
                            <i class="nav-icon "></i> Thêm mới Cấu hình</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if(auth('admin')->user()->can('admin-pms', 'admin.settingFooter.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.settingFooter.getList','admin.settingFooter.getCreate'])) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0);">
                    <i class="nav-icon icon-docs"></i>Quản lý Footer</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.settingFooter.getList'])) active @endif" href="{{ route('admin.settingFooter.getList') }}">
                            <i class="nav-icon "></i> Danh sách Footer</a>
                    </li>
                    
                </ul>
            </li>
            @endif
            @if(auth('admin')->user()->can('admin-pms', 'admin.advertise.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.advertise.getList','admin.advertise.getCreate'])) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0);">
                    <i class="nav-icon icon-docs"></i>Quản lý quảng cáo</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.advertise.getList'])) active @endif" href="{{ route('admin.advertise.getList') }}">
                            <i class="nav-icon "></i> Danh sách quảng cáo</a>
                    </li>
                    @if(auth('admin')->user()->can('admin-pms', 'admin.advertise.getCreate'))
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.advertise.getCreate'])) active @endif" href="{{ route('admin.advertise.getCreate') }}">
                            <i class="nav-icon "></i> Thêm mới quảng cáo</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
           
            @if(auth('admin')->user()->can('admin-pms', 'admin.user.getList'))
            <li class="nav-item nav-dropdown @if(in_array($currentRoute,['admin.user.getList'])) open @endif">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0);">
                    <i class="nav-icon icon-people"></i>Khách hàng</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link @if(in_array($currentRoute,['admin.user.getList'])) active @endif" href="{{ route('admin.user.getList') }}">
                            <i class="nav-icon "></i> Danh sách</a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
