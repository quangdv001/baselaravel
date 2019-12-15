<header>
    <div class="top-layout">
        <div class="container">
            <div class="row">
                <div class="top">
                    <div class="top-element">
                        <ul>
                            <li><span><strong> <i class="material-icons">phone_in_talk</i>&nbsp;</strong><a
                                        href="#link">0981908099&nbsp;</a></span></li>
                            <li><span class="separate"></span></li>
                            <li><span><strong><i class="material-icons">send</i>&nbsp;</strong><a href="#link">Hỗ
                                        trợ&nbsp;</a></span></li>
                        </ul>
                    </div>
                    <div class="pull-right">
                        <ul>
                            <li>
                                <div class="social-icon"><a><i class="fab fa-facebook-f"></i></a>
                                </div>
                            </li>
                            <li>
                                <div class="social-icon"><a><i class="fab fa-google-plus-g"></i></a>
                                </div>
                            </li>
                            <li>
                                <div class="social-icon"><a><i class="fab fa-youtube"></i></a>
                                </div>
                            </li>
                            <li>
                                <div class="social-icon"><a><i class="fab fa-twitter"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-layout">
        <div class="container">
            <div class="row">
                <div class="col-sm-auto col-12">
                    <h3 class="logo" id="logo"><a href="index.html"><img src="./assets/images/logo.png"></a></h3>
                </div>
                <div class="col align-self-center"><span class="search-form">
                        <form class="form" action="{{ route('site.article.search') }}">
                            <select name="type">
                                <option value="0" @if(old('type') == 0) selected @endif>Tin tức</option>
                                <option value="1" @if(old('type') == 1) selected @endif>Cho thuê</option>
                            </select>
                        <input class="search-input" name="name" type="text" placeholder="Nhập từ khóa..." value="{{ old('name') }}">
                            <button class="search-button" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </span></div>
                <div class="col align-self-center">
                    <!-- NAVIGATION -->
                    <div class="navigation nav-right">
                        <ul>
                            @if(!auth()->check())
                            <li class="btn-wrapper btn-success">
                                <button class="btn btn-success" data-toggle="modal" data-target="#login-panel"><i
                                        class="fa fa-user"></i> Đăng nhập</button>
                            </li>
                            <li class="btn-wrapper btn-primary">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#register-panel"><i
                                        class="fa fa-lock"></i> Đăng ký</button>
                            </li>
                            @else
                            <li><a href="javascript:void(0);">{{ auth()->user()->name }}</a>
                                <ul>
                                    <li><a href="javascript:void(0);">Thông tin</a>
                                    </li>
                                    <li><a href="javascript:void(0);">Quản lý khu trọ</a>
                                    </li>
                                    <li><a href="javascript:void(0);">Tài khoản</a>
                                    </li>
                                    <li><a href="{{ route('site.auth.logout') }}">Thoát</a>
                                    </li>
                                </ul>
                            </li>
                            @endif
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
                            {!! $htmlCategory !!}
                            
                            {{-- <ul>
                                <li class="active"><a href="./index.html"><i class="fa fa-home"></i><span
                                            class="isMobile">&nbsp;Trang chủ</span></a>
                                </li>
                                <li><a href="./category.html">Giới thiệu</a>
                                </li>
                                <li><a href="./category.html">Nhà đất Hà nội</a>
                                    <ul>
                                        <li><a href="./category.html">Bán nhà đất Hà Nội</a>
                                        </li>
                                        <li><a href="./category.html">Cho Thuê xưởng Hà Nội</a>
                                        </li>
                                        <li><a href="./single.html">Dự án khu vực Hà Nội</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="mega-menu three-items-menu"><a href="./project.html">Môi giới - Sàn giao
                                        dịch</a>
                                </li>
                                <li><a href="./category-forent.html">Cho thuê</a>
                                </li>
                                <li><a href="./category-forent.html">GREENMARKET</a>
                                </li>
                                <li><a href="./category.html">Đô thị</a>
                                    <ul>
                                        <li><a href="./category.html">Đô thị mới</a>
                                        </li>
                                        <li><a href="./category.html">Đô thị vệ tinh</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="./category.html">Tin tức</a>
                                </li>
                                <li><a href="./category.html">Trợ giúp pháp lý</a>
                                    <ul>
                                        <li><a href="./category.html">Thủ tục hành chính</a>
                                        </li>
                                        <li><a href="./category.html">Công chứng</a>
                                        </li>
                                        <li><a href="./category.html">Luật</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="./single.html">Liên hệ</a>
                                </li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
                <div class="col align-self-end">
                    <div class="pull-right">
                        <!-- NAVIGATION -->
                        <div class="navigation nav-top">
                            {{-- <ul>
                                <li><a href="./single.html">Hỗ trợ</a>
                                    <ul>
                                        <li><a href="./category.html">Khuyến mãi</a>
                                        </li>
                                        <li><a href="./category.html">Chính sách</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
