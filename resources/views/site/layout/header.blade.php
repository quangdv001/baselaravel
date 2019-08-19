<div class="header-layout" @if($currentRoute=='site.home.index')
    style="background:#fff @if(sizeof($list_sliders) > 0) url({{ $list_sliders[0]['img'] }}) @endif no-repeat center top / 100% 100%;min-height: 80vh;"
    @endif>
    <div class="top-layout light-text section-dark">
        <div class="container">
            <div class="top">
                <div class="top-element">
                    <ul>
                        <li><span><strong> <i class="material-icons">phone_in_talk</i>&nbsp;</strong><a
                                    href="#link">Hotline:&nbsp;</a><span>- &nbsp;</span><a
                                    href="#link">0901.792.566&nbsp;</a></span></li>
                        <li><span class="separate"></span></li>
                        <li><span><strong><i class="material-icons">send</i>&nbsp;</strong><a
                                    href="#link">@lang('header.contact')
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
                                <li><a rel="alternate" hreflang="en"
                                        href="{{ route('site.home.setLocale', 'en') }}"><img
                                            src="{{ asset('public/assets/site/themes/assets/images/flags/us.png') }}"
                                            title="English" alt="English" /><span>@lang('header.lang_en')</span></a>
                                </li>
                                <li class="active"><a rel="alternate" hreflang="vi"
                                        href="{{ route('site.home.setLocale', 'vi') }}"><img
                                            src="{{ asset('public/assets/site/themes/assets/images/flags/vn.png') }}"
                                            title="Tiếng Việt"
                                            alt="Tiếng Việt" /><span>@lang('header.lang_vi')</span></a></li>
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
                            <li @if($currentRoute == 'site.home.index') class="active" @endif><a href="{{ route('site.home.index') }}">@lang('header.home')</a>
                            </li>
                            <li @if($currentRoute == 'site.home.about') class="active" @endif><a href="{{ route('site.home.about') }}">@lang('header.about')</a>
                            </li>
                            <li @if($currentRoute == 'site.home.booking') class="active" @endif><a href="{{ route('site.home.booking') }}">@lang('header.booking')</a>
                            </li>
                            <li @if($currentRoute == 'site.home.journeys_fare ') class="active" @endif><a href="{{ route('site.home.journeys_fare') }}">@lang('home.journeys_fare')</a>
                            </li>
                            <li @if(strpos($_SERVER['REQUEST_URI'], "i-3") !== false) !== false class="active" @endif><a href="{{ route('site.article.index',['id' => 3, 'slug' => 'article']) }}">@lang('header.sale')</a>
                            </li>
                            <li @if(strpos($_SERVER['REQUEST_URI'], "i-1") !== false) class="active" @endif><a href="{{ route('site.article.index',['id' => 1, 'slug' => 'article']) }}">@lang('header.article')</a>
                            </li>
                            <li @if($currentRoute == 'site.home.regulations') class="active" @endif><a href="{{ route('site.home.regulations') }}">@lang('header.regulations')</a>
                            </li>
                            <li @if($currentRoute == 'site.home.contact') class="active" @endif><a href="{{ route('site.home.contact') }}">@lang('header.contact')</a>
                            </li>
                            <li class="hideSubIcon">
                                <!-- language -->
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
                                                title="Tiếng Anh" alt="Tiếng Anh" /> @lang('header.lang_en')<span
                                                class="caret"></span>
                                            @endif
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right language_bar_chooser">
                                            <li><a rel="alternate" hreflang="en"
                                                    href="{{ route('site.home.setLocale', 'en') }}"><img
                                                        src="{{ asset('public/assets/site/themes/assets/images/flags/us.png') }}"
                                                        title="English" alt="English" /><span>@lang('header.lang_en')</span></a>
                                            </li>
                                            <li class="active"><a rel="alternate" hreflang="vi"
                                                    href="{{ route('site.home.setLocale', 'vi') }}"><img
                                                        src="{{ asset('public/assets/site/themes/assets/images/flags/vn.png') }}"
                                                        title="Tiếng Việt"
                                                        alt="Tiếng Việt" /><span>@lang('header.lang_vi')</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- end language -->
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
                        @if(sizeof($list_sliders) > 0)
                        <ol class="carousel-indicators">
                            @foreach($list_sliders as $key => $slider)
                            <li data-target="#carouselSlider" data-slide-to="{{ $key }}" class="@if($key==0) active @endif"></li>
                            @endforeach
                        </ol>
                        @endif
                        <div class="carousel-inner">
                        @if(sizeof($list_sliders) > 0)
                            @foreach($list_sliders as $key => $slider)
                            <div class="carousel-item @if($key==0) active @endif" data-node=".header-layout" data-repeat="no-repeat"
                                data-size="100% 100%" data-position="center top"
                                data-image="{{ $slider->img }}">
                                <div class="row">
                                    <div class="col-sm order-last text-center"><img
                                            src="@if(isset($slider->img_inside)) {{ $slider->img_inside }} @else {{ asset('public/assets/site/themes/assets/images/slide-img.png') }} @endif"
                                            alt="" /></div>
                                    <div class="col-sm slide-caption align-self-center">
                                        <h3><strong>@lang('home.title_slide_company_1')</strong></h3>
                                        <h4>@lang('home.title_slide_company_2')</h4>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif    
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
                  <form class="form-services-layout" action="{{ route('site.home.booking') }}">
                        <div class="form-header">
                            <div class="title">@lang('home.booking_online')</div>
                            <div class="subtitle">@lang('home.contact_us_first')</div>
                        </div>
                        <form class="form form-services" id="bookingform">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-10 form-group">
                                        <div class="toggle-switch">
                                            <input class="switch-toggle" id="khuhoi" type="checkbox" name="is_round_trip" value="1">
                                            <label class="switch-viewport" for="khuhoi">
                                                <div class="switch-slider">
                                                    <div class="switch-button"> </div>
                                                    <div class="switch-content left"><span>@lang('home.one_way')</span></div>
                                                    <div class="switch-content right"><span>@lang('home.round_trip')</span></div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="bmd-label-floating" for="item-form-0">@lang('home.from')</label>
                                        <select class="form-control" name="start_id">
                                            @if(sizeof($province) > 0)
                                              @foreach($province as $k => $v)
                                                <option value="{{ $k }}">{{ $v }}</option>
                                              @endforeach
                                            @endif
                                        </select><span class="float-icon"><i class="material-icons">room</i></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="bmd-label-floating" for="item-form-1">@lang('home.to')</label>
                                        <select class="form-control" name="end_id">
                                          @if(sizeof($province) > 0)
                                            @foreach($province as $k => $v)
                                              <option value="{{ $k }}">{{ $v }}</option>
                                            @endforeach
                                          @endif
                                        </select><span class="float-icon"><i class="material-icons">room</i></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="bmd-label-floating" for="item-form-2">@lang('home.number')</label>
                                        <input class="form-control" type="text" id="item-form-2" name="qty"/><span
                                            class="float-icon"><i class="material-icons">supervisor_account</i></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="bmd-label-floating" for="start-date">@lang('home.departure_date')</label>
                                        <input class="form-control datepicker" type="text" id="start-date" name="start_time"
                                            data-date-format="DD, MM d" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="bmd-label-floating" for="end-date" >@lang('home.return_date')</label>
                                        <input class="form-control datepicker" type="text" id="end-date" name="end_time"
                                            data-date-format="DD, MM d" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="bmd-label-floating" for="item-form-6" >@lang('home.note')</label>
                                        <input class="form-control" type="text" id="item-form-6" name="note"/><span
                                            class="float-icon"><i class="material-icons">event_seat</i></span>
                                    </div>
                                    <div class="col-12 text-right">
                                        <button class="btn btn-primary text-uppercase" type="submit">@lang('home.search')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
