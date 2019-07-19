@extends('site.layout.main')
@section('title')
@lang('header.about')
@endsection
@section('content')
<div class="main">
    <div class="subpage-cover"
        style="background: #2d71a2 url({{ asset('public/assets/site/themes/assets/images/subpage-cover.jpg') }}) no-repeat center top/ auto 100%">
        <div class="page-title d-flex align-items-center justify-content-center"><span>@lang('header.about_us')</span></div>
    </div>
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <ol class="breadcrumb breadcrumb-dot">
                    <li class="breadcrumb-item"><i class="material-icons">home</i><a
                            href="{{ route('site.home.index' )}}" title="Trang chủ">@lang('header.home')</a></li>
                    <li class="breadcrumb-item active"><span>@lang('header.about')</span></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="section-main">
        <div class="container">
            <div class="row">
                <div class="col col-sm-9">
                    <div class="row">
                        <div class="col">
                            <div class="detail-post">
                                <h1 class="page-title"><a href="#">Công ty Cổ phần vận tải và thương mại Livitrans</a>
                                </h1>
                                <div class="news-post">
                                    <div class="post-meta-container"><span class="post-meta-item"><i
                                                class="far fa-clock"></i> Th3-27/10/2015</span><span
                                            class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin">
                                                Admin</a></span></div>
                                    <div class="post-sapo">Với bề dầy hoạt động 10 năm, Livitrans luôn là sự tin cậy của
                                        mọi khách hàng và đối tác. Bởi lẽ, dịch vụ không ngừng hoàn thiện để hài lòng
                                        khách hàng là con đường thành công của chúng tôi.</div>
                                    <div class="row">
                                        <div class="col-sm-6"><img src="./assets/images/logo.png" alt=""
                                                style="width:100%"></div>
                                        <div class="col-sm-6">
                                            <ul class="list-categories">
                                                <li><a> Địa chỉ Phòng vé: Số 1 Trần Quý Cáp - Phường Văn Miếu - Quận
                                                        Đống Đa - Hà nội</a></li>
                                                <li><a href="tell:0243.9429918"> <i
                                                            class="material-icons">phone_in_talk</i> Hotline:
                                                        0243.9429918</a></li>
                                                <li><a href="tell: 0904.101.488"> <i
                                                            class="material-icons">phone_in_talk</i> Điện thoại phòng
                                                        vé: 0904.101.488</a></li>
                                                <li><a href="mailto:booking@livitrans.com"> <i
                                                            class="material-icons">mail_outline</i> Email:
                                                        booking@livitrans.com</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="feature-box-layout">
                                        <div class="feature-box">
                                            <div class="feature-box-icon">
                                                <div class="icons icon-mission"></div>
                                            </div>
                                            <div class="feature-box-info">
                                                <h4 class="feature-title">@lang('home.about')</h4>
                                                <p class="mb-4">@lang('home.about_content_1')</p>
                                            </div>
                                        </div>
                                        <div class="feature-box">
                                            <div class="feature-box-icon">
                                                <div class="icons icon-share"></div>
                                            </div>
                                            <div class="feature-box-info">
                                                <h4 class="feature-title">@lang('home.about_title_2')</h4>
                                                <p class="mb-4">@lang('home.about_content_2')</p>
                                            </div>
                                        </div>
                                        <div class="feature-box">
                                            <div class="feature-box-icon">
                                                <div class="icons icon-diamond"></div>
                                            </div>
                                            <div class="feature-box-info">
                                                <h4 class="feature-title">@lang('home.about_title_3')</h4>
                                                <p class="mb-4">@lang('home.about_content_3')</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="title">Mọi thông tin xin liên hệ :</div>
                                <ul class="list-categories">
                                    <li><a href="#address:"> Phòng tiễn khách: Khách sạn Cây Xoài 118 Lê Duẩn - Hoàn
                                            Kiếm - Hà Nội</a></li>
                                    <li><a> Địa chỉ Phòng vé: Số 1 Trần Quý Cáp - Phường Văn Miếu - Quận Đống Đa - Hà
                                            nội</a></li>
                                </ul>
                                <div class="list-post-aside">
                                    <h3 class="module-title"><a href="#">Tin Liên quan</a></h3>
                                    <div class="news-post line-bottom list-style-post small-post">
                                        @foreach ($data as $v)
                                        <div class="news-post-content">
                                            <div class="post-title title"><i class="list-icon fas fa-circle"></i><a
                                                    class="news-post-link" href="{{ route('site.article.detail', ['id' => $v->id, 'slug' => $v->slug]) }}">{{ $v->title }}</a></div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('site.layout.sidebar')
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_js')
@endsection
