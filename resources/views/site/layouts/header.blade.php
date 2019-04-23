<header>
    {{-- TOP --}}
    @include('site.layouts.top')
    {{-- END TOP --}}
    <div class="header-layout">
        <div class="container">
        <div class="row">
            <div class="col-sm-auto col-12">
            <h3 class="logo" id="logo"><a href="index.html"><img src="./assets/images/logo.png"></a></h3>
            </div>
            <div class="col align-self-center"><span class="search-form">
                <form class="form">
                <input class="search-input" type="text" placeholder="Nhập từ khóa...">
                <button class="search-button"><i class="fas fa-search"></i></button>
                </form></span></div>
            <div class="col align-self-center">
            <!-- NAVIGATION -->
            <div class="navigation nav-top">
                <ul>
                <li><a href="./category.html">Khuyến mãi</a>
                </li>
                <li><a href="./category.html">Tin tức</a>
                </li>
                <li><a href="./single.html">Liên hệ</a>
                </li>
                <li><a href="./index.html"><i class="fas fa-award"></i><span class="isMobile">&nbsp;Giỏ hàng</span></a>
                </li>
                </ul>
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
                    @include('site.layouts.nav', ['categories'=>$categories])
                </div>
            </div>
            </div>
            <div class="col align-self-end">
            <div class="pull-right">
                <!-- NAVIGATION -->
                <div class="navigation nav-right">
                <ul>
                    <li><a href="./">Tài khoản</a>
                    <ul>
                        <li><a href="./category.html">Thông tin</a>
                        </li>
                        <li><a href="./category.html">Cá nhân</a>
                        </li>
                        <li><a href="./category.html">Tài khoản</a>
                        </li>
                        <li><a href="./single.html">Thoát</a>
                        </li>
                    </ul>
                    </li>
                </ul>
                </div>
            </div>
            </div>
        </div>
        </div>
    </nav>
</header>
