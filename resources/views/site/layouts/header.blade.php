<header>
    {{-- TOP --}}
    @include('site.layouts.top')
    {{-- END TOP --}}
    <div class="header-layout">
        <div class="container">
        <div class="row">
            <div class="col-sm-auto col-12">
            <h3 class="logo" id="logo"><a href="/"><img src="{{ asset('assets/images/logo.png') }}"></a></h3>
            </div>
            <div class="col align-self-center">
                <span class="search-form">
                    <form class="form" method="GET" action="{{ route('site.home.search') }}">
                        <select name="t">
                            <option value="1">Tin Tức</option>
                            <option value="2">Pháp Luật</option>
                            <option value="3">Dự án nhà đát</option>
                            <option value="4">Cho Thuê</option>
                        </select>
                        <input class="search-input" type="text" placeholder="Nhập từ khóa..." name="q">
                        <button class="search-button"><i class="fas fa-search"></i></button>
                    </form>
                </span>
            </div>
            <div class="col align-self-center">
            <!-- NAVIGATION -->
            <div class="navigation nav-header">
                @if ($headerCenterMenu)
                    @include('site.layouts.nav.index', ['menu'=>$headerCenterMenu])
                @endif
            </div>
            </div>
        </div>
        </div>
    </div>
    <nav class="navi-layout fix-top">
        <div class="container"> 
        <div class="row">
            <div class="col-md-auto">
            <div class="row">
                <!-- NAVIGATION -->
                <div class="navigation nav-left">
                    @if ($mainMenu)
                        @include('site.layouts.nav.index', ['menu'=>$mainMenu])
                    @endif
                </div>
            </div>
            </div>
            <div class="col align-self-end">
            <div class="pull-right">
                <!-- NAVIGATION -->
                <div class="navigation nav-right">
                @guest
                    <ul>
                        <li><a href="/login">Đăng nhập</a></li>
                        <li><a href="/register">Đăng ký</a></li>
                    </ul>
                @else
                    <ul>
                        <li><a href="./">Tài khoản</a>
                        <ul>
                            <li><a href="./category.html">Thông tin</a>
                            </li>
                            <li><a href="./category.html">Cá nhân</a>
                            </li>
                            <li><a href="./category.html">Tài khoản</a>
                            </li>
                            <li><a href="/logout">Thoát</a>
                            </li>
                        </ul>
                        </li>
                    </ul>                    
                @endguest
                </div>
            </div>
            </div>
        </div>
        </div>
    </nav>
</header>
