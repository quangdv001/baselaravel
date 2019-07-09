<div class="header-layout"
@if($currentRoute == 'site.home.index') style="background:#fff url({{ asset('public/assets/site/themes/assets/images/slide-bg.jpg') }}) no-repeat center top / 100% auto;min-height: 80vh;" @endif>
    <div class="top-layout light-text section-dark">
        <div class="container">
            <div class="top">
                <div class="top-element">
                    <ul>
                        <li><span><strong> <i class="material-icons">phone_in_talk</i>&nbsp;</strong><a
                                    href="#link">Hotline:&nbsp;</a><span>- &nbsp;</span><a
                                    href="#link">0123.456.798&nbsp;</a></span></li>
                        <li><span class="separate"></span></li>
                        <li><span><strong><i class="material-icons">send</i>&nbsp;</strong><a href="#link">@lang('header.contact')
                                    &nbsp;</a></span></li>
                    </ul>
                </div>
                <?php 
                    $locale = App::getLocale();
                ?>
                <div class="pull-right">
                    <div class="language-wrapper">
                        <div class="dropdown">
                            <button class="dropdown-toggle language_bar_button" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                @if($locale == 'vi')
                                <img src="{{ asset('public/assets/site/themes/assets/images/flags/vn.png') }}"
                                    title="Tiếng Việt" alt="Tiếng Việt" /> @lang('header.lang_vi')<span
                                    class="caret"></span>
                                @else    
                                <img src="{{ asset('public/assets/site/themes/assets/images/flags/us.png') }}"
                                    title="Tiếng Việt" alt="Tiếng Việt" /> @lang('header.lang_en')<span
                                    class="caret"></span>
                                @endif
                                </button>
                            <ul class="dropdown-menu dropdown-menu-right language_bar_chooser">
                            <li><a rel="alternate" hreflang="en" href="{{ route('site.home.setLocale', 'en') }}"><img
                                            src="{{ asset('public/assets/site/themes/assets/images/flags/us.png') }}"
                                            title="English" alt="English" /><span>@lang('header.lang_en')</span></a></li>
                                <li class="active"><a rel="alternate" hreflang="vi" href="{{ route('site.home.setLocale', 'vi') }}"><img
                                            src="{{ asset('public/assets/site/themes/assets/images/flags/vn.png') }}"
                                            title="Tiếng Việt" alt="Tiếng Việt" /><span>@lang('header.lang_vi')</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header fix-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-auto col-12">
                    <h3 class="logo" id="logo"><a href="{{ route('site.home.index') }}"><img
                                src="{{ asset('public/assets/site/themes/assets/images/logo.png') }}"></a></h3>
                </div>
                <div class="col align-self-center text-right zero-height-sx">
                    <!-- NAVIGATION -->
                    <div class="navigation nav-left">
                        <ul>
                        <li class="active"><a href="{{ route('site.home.index') }}">@lang('header.home')</a>
                            </li>
                            <li><a href="{{ route('site.home.about') }}">@lang('header.about')</a>
                            </li>
                            <li><a href="{{ route('site.home.price') }}">@lang('header.train')</a>
                            </li>
                            <li><a href="{{ route('site.article.index',['id' => 2, 'slug' => 'tour']) }}">@lang('header.tour')</a>
                            </li>
                            <li><a href="{{ route('site.home.livitrans') }}">@lang('header.image')</a>
                            </li>
                            <li><a href="{{ route('site.article.index',['id' => 1, 'slug' => 'article']) }}">@lang('header.article')</a>
                            </li>
                            <li><a href="{{ route('site.home.contact') }}">@lang('header.contact')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($currentRoute == 'site.home.index')
    <div class="slider-layout">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-10">
                    <div id="carouselSlider" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselSlider" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselSlider" data-slide-to="1"></li>
                            <li data-target="#carouselSlider" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-node=".header-layout" data-repeat="no-repeat"
                                data-size="100% auto" data-position="center top"
                                data-image="{{ asset('public/assets/site/themes/assets/images/slide-bg.jpg') }}">
                                <div class="row">
                                    <div class="col-sm order-last text-center"><img
                                            src="{{ asset('public/assets/site/themes/assets/images/slide-img.png') }}"
                                            alt="" /></div>
                                    <div class="col-sm slide-caption align-self-center">
                                        <h3><strong>NỤ CƯỜI RẠNG RỠ</strong></h3>
                                        <h4>TRÊN MỌI NẺO ĐƯỜNG</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" data-node=".header-layout" data-repeat="no-repeat"
                                data-size="100% auto" data-position="center top"
                                data-image="https://homevhp.com/wp-content/uploads/2019/06/bg-home.jpg">
                                <div class="row">
                                    <div class="col-sm order-last text-center"><img
                                            src="{{ asset('public/assets/site/themes/assets/images/slide-img.png') }}"
                                            alt="" /></div>
                                    <div class="col-sm slide-caption align-self-center">
                                        <h3><strong>NỤ CƯỜI RẠNG RỠ</strong></h3>
                                        <h4>TRÊN MỌI NẺO ĐƯỜNG</h4>
                                        <p>Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình
                                            bày và dàn trang phục vụ cho in ấn.</p><a
                                            class="btn btn-raised btn-md btn-primary" href="#0"><span>Xem
                                                thêm</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" data-node=".header-layout" data-repeat="no-repeat"
                                data-size="100% auto" data-position="center top"
                                data-image="http://www.livitrans.com/upload/images/hue1.jpg">
                                <div class="row">
                                    <div class="col-sm order-last text-center"><img
                                            src="{{ asset('public/assets/site/themes/assets/images/slide-img.png') }}"
                                            alt="" /></div>
                                    <div class="col-sm slide-caption align-self-center">
                                        <h3><strong>NỤ CƯỜI RẠNG RỠ</strong></h3>
                                        <h4>TRÊN MỌI NẺO ĐƯỜNG</h4>
                                        <p>Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình
                                            bày và dàn trang phục vụ cho in ấn.</p><a
                                            class="btn btn-raised btn-md btn-primary" href="#0"><span>Xem
                                                thêm</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselSlider" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselSlider" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-slider-layout">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-10">
                    <div class="form-services-layout">
                        <div class="form-header">
                            <div class="title">Đặt vé trực tuyến</div>
                            <div class="subtitle">Liên hệ trước với chũng tôi</div>
                        </div>
                        <form class="form form-services" id="bookingform">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-10 form-group">
                                        <div class="toggle-switch">
                                            <input class="switch-toggle" id="khuhoi" type="checkbox">
                                            <label class="switch-viewport" for="khuhoi">
                                                <div class="switch-slider">
                                                    <div class="switch-button"> </div>
                                                    <div class="switch-content left"><span>Một chiều</span></div>
                                                    <div class="switch-content right"><span>Khứ hồi</span></div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="bmd-label-floating" for="item-form-0">Điểm đi</label>
                                        <input class="form-control" type="text" value="Hà nội" id="item-form-0"><span
                                            class="float-icon"><i class="material-icons">room</i></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="bmd-label-floating" for="item-form-1">Điểm đến</label>
                                        <input class="form-control" type="text" value="Sài gòn" id="item-form-1"><span
                                            class="float-icon"><i class="material-icons">room</i></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="bmd-label-floating" for="item-form-2">Số lượng</label>
                                        <input class="form-control" type="text" value="2 người lớn 1 trẻ em"
                                            id="item-form-2"><span class="float-icon"><i
                                                class="material-icons">supervisor_account</i></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="bmd-label-floating" for="start-date">Ngày đi</label>
                                        <input class="form-control datepicker" type="text" value="12/12/2019"
                                            id="start-date" data-date-format="DD, MM d">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="bmd-label-floating" for="end-date">Ngày về</label>
                                        <input class="form-control datepicker" type="text" value="12/12/2019"
                                            id="end-date" data-date-format="DD, MM d">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="bmd-label-floating" for="item-form-5">Loại</label>
                                        <input class="form-control" type="text" value="Mền điều hòa"
                                            id="item-form-5"><span class="float-icon"><i
                                                class="material-icons">event_seat</i></span>
                                    </div>
                                    <div class="col-12 text-right">
                                        <button class="btn btn-primary text-uppercase" type="submit">Tìm kiếm</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
