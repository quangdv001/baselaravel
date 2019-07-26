
<footer class="footer dark">
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <div class="clearfix"><a class="title f-logo"><img
                                src="{{ asset('public/assets/site/themes/assets/images/logo-white.png') }}"
                                alt="CÔNG TY CP VẬN TẢI VÀ THƯƠNG MẠI LIVITRANS ( LIVITRANS JSC,..)." /></a>
                        <div class="f-slogan"><strong>@lang('footer.livi_name')</strong></div>
                    </div>
                    <div>
                        <p></p>
                        <div class="social-icon"><a href="@if(isset($social['facebook'])) {{ $social['facebook'] }} @else # @endif"><i class="fab fa-facebook-f"></i></a>
                        </div>
                        <div class="social-icon"><a href="@if(isset($social['google-plus'])) {{ $social['google-plus'] }} @else # @endif"><i class="fab fa-google-plus-g"></i></a>
                        </div>
                        <div class="social-icon"><a href="@if(isset($social['twitter'])) {{ $social['twitter'] }} @else # @endif"><i class="fab fa-twitter"></i></a>
                        </div>
                        <div class="social-icon"><a href="@if(isset($social['youtube'])) {{ $social['youtube'] }} @else # @endif"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                    <div>
                        <ul class="list-group list-group-flush">
                            <li><a href="#address:"><i class="material-icons list-style">fiber_manual_record</i>@lang('footer.footer_1') @if(isset($social['phong-don-tien'])) {{ $social['phong-don-tien'] }} @endif </a></li>
                            <li><a><i class="material-icons list-style">fiber_manual_record</i>@lang('footer.footer_2') @if(isset($social['dia-chi-phong-ve'])) {{ $social['dia-chi-phong-ve'] }} @endif</a></li>
                            <li><a href="@if(isset($social['hotline'])) tell:{{$social['hotline']}} @else # @endif"><i
                                        class="material-icons list-style">fiber_manual_record</i><i
                                        class="material-icons">phone_in_talk</i> @lang('footer.footer_3') @if(isset($social['hotline'])) {{ $social['hotline'] }} @endif</a></li>
                            <li><a href="@if(isset($social['dien-thoai-phong-ve'])) tell:{{$social['dien-thoai-phong-ve']}} @else # @endif"><i
                                        class="material-icons list-style">fiber_manual_record</i><i
                                        class="material-icons">phone_in_talk</i> @lang('footer.footer_4') @if(isset($social['dien-thoai-phong-ve'])) {{ $social['dien-thoai-phong-ve'] }} @endif</a>
                            </li>
                            <li><a href="mailto:booking@livitrans.com"><i
                                        class="material-icons list-style">fiber_manual_record</i><i
                                        class="material-icons">mail_outline</i> @lang('footer.footer_5') @if(isset($social['email'])) {{ $social['email'] }} @endif</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                                <h3 class="title divider-bottom">@lang('footer.contact')</h3>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li><a href="#link"><i class="material-icons list-style">fiber_manual_record</i>@lang('footer.contact_1')</a></li>
                                <li><a href="#link"><i class="material-icons list-style">fiber_manual_record</i>@lang('footer.contact_2')</a></li>
                                <li><a href="#link"><i class="material-icons list-style">fiber_manual_record</i>@lang('footer.contact_3')</a></li>
                                <li><a href="{{ route('site.home.regulations') }}"><i class="material-icons list-style">fiber_manual_record</i>@lang('footer.contact_4')</a></li>
                                <li><a href="#link"><i class="material-icons list-style">fiber_manual_record</i>@lang('footer.contact_5')</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <div>
                                <h3 class="title divider-bottom">@lang('footer.sitemap')</h3>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li><a href="{{ route('site.home.about') }}"><i class="material-icons list-style">fiber_manual_record</i>@lang('footer.sitemap_1')</a></li>
                                <li><a href="{{ route('site.home.booking') }}"><i class="material-icons list-style">fiber_manual_record</i>@lang('footer.sitemap_2')</a></li>
                                <li><a href="{{ route('site.article.index',['id' => 3, 'slug' => 'article']) }}"><i class="material-icons list-style">fiber_manual_record</i>@lang('footer.sitemap_3')</a></li>
                                <li><a href="{{ route('site.article.index',['id' => 1, 'slug' => 'article']) }}"><i class="material-icons list-style">fiber_manual_record</i>@lang('footer.sitemap_4')</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">&copy;@if(isset($social['copyright'])) {{ $social['copyright'] }} @endif</div>
    </div>
</footer>
