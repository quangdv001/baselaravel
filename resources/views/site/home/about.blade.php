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
                            href="{{ route('site.home.index' )}}" title="Trang chủ">Trang chủ</a></li>
                    <li class="breadcrumb-item active"><span>@lang('header.about')</span></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="section-main">
        <div class="container">
            <div class="row">
                <div class="col col-sm-9 border-sm-right">
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
                                                <h4 class="feature-title">Giới thiệu</h4>
                                                <p class="mb-4">Với bề dầy hoạt động 10 năm, Livitrans luôn là sự tin
                                                    cậy của mọi khách hàng và đối tác. Bởi lẽ, dịch vụ không ngừng hoàn
                                                    thiện để hài lòng khách hàng là con đường thành công của chúng tôi.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="feature-box">
                                            <div class="feature-box-icon">
                                                <div class="icons icon-share"></div>
                                            </div>
                                            <div class="feature-box-info">
                                                <h4 class="feature-title">Đổi mới</h4>
                                                <p class="mb-4">Sau thời gian nâng cấp dịch vụ, hoàn chỉnh các quy trình
                                                    phục vụ và đầu tư mới cơ sở vật chất, chúng tôi tự tin trở lại với
                                                    quý khách hàng yêu quý với một diện mạo mới.</p>
                                            </div>
                                        </div>
                                        <div class="feature-box">
                                            <div class="feature-box-icon">
                                                <div class="icons icon-diamond"></div>
                                            </div>
                                            <div class="feature-box-info">
                                                <h4 class="feature-title">Chất lượng</h4>
                                                <p class="mb-4">Và chính thức từ tháng 10 năm 2017, chúng tôi sẵn sàng
                                                    đưa vào hoạt động đoàn tàu Du lịch chất lượng 4 sao với chất lượng
                                                    vượt trội dành cho quý khách.</p>
                                                <p class="mb-4">Ban điều hành Công ty chúng tôi xin trân trọng gửi tới
                                                    quý khách hàng và đối tác lời chúc tốt đẹp nhất thông qua chất lượng
                                                    dịch vụ của mình.</p>
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
                <div class="col-sm-3 sidebar">
                    <div class="list-post-aside">
                        <h3 class="module-title"><a href="#">Danh mục</a></h3>
                        <ul class="list-categories">
                            <li><a href="#link"><i class="material-icons list-style">chevron_right</i>Đặt vé</a></li>
                            <li><a href="#link"><i class="material-icons list-style">chevron_right</i>Du lịch</a></li>
                            <li><a href="#link"><i class="material-icons list-style">chevron_right</i>Hủy chuyến</a>
                            </li>
                            <li><a href="#link"><i class="material-icons list-style">chevron_right</i>Gửi hành lý</a>
                            </li>
                            <li><a href="#link"><i class="material-icons list-style">chevron_right</i>Ký gửi</a></li>
                        </ul>
                    </div>
                    <div class="list-post-aside">
                        <h3 class="module-title"><a href="#">Tin nổi bật</a></h3>
                        <div class="news-post line-bottom small-post"><a class="news-post-image-link"
                                href="./single.html">
                                <figure class="image-container rectangle-image">
                                    <div class="featured-image-overlay"><span class="featured-image-icon"><i
                                                class="fa fa-camera"></i></span></div><img class="img-responsive"
                                        src="https://bit.ly/2ESxuyd" alt="title alt" />
                                </figure>
                            </a>
                            <div class="news-post-content">
                                <h3 class="post-title title"><a class="news-post-link" href="./single.html">Lorem Ipsum
                                        là gì, Tại sao lại sử dụng nó?</a></h3>
                                <div class="post-meta-container"><span class="post-meta-item"><i
                                            class="far fa-clock"></i> Th3-27/10/2015</span><span
                                        class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin">
                                            Admin</a></span></div>
                            </div>
                        </div>
                        <div class="news-post line-bottom small-post">
                            <div class="news-post-content">
                                <h3 class="post-title title"><a class="news-post-link" href="./single.html">Lorem Ipsum
                                        là gì, Tại sao lại sử dụng nó?</a></h3>
                                <div class="post-meta-container"><span class="post-meta-item"><i
                                            class="far fa-clock"></i> Th3-27/10/2015</span><span
                                        class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin">
                                            Admin</a></span></div>
                            </div>
                        </div>
                        <div class="news-post line-bottom small-post">
                            <div class="news-post-content">
                                <h3 class="post-title title"><a class="news-post-link" href="./single.html">Lorem Ipsum
                                        là gì, Tại sao lại sử dụng nó?</a></h3>
                                <div class="post-meta-container"><span class="post-meta-item"><i
                                            class="far fa-clock"></i> Th3-27/10/2015</span><span
                                        class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin">
                                            Admin</a></span></div>
                            </div>
                        </div>
                        <div class="news-post line-bottom small-post">
                            <div class="news-post-content">
                                <h3 class="post-title title"><a class="news-post-link" href="./single.html">Lorem Ipsum
                                        là gì, Tại sao lại sử dụng nó?</a></h3>
                                <div class="post-meta-container"><span class="post-meta-item"><i
                                            class="far fa-clock"></i> Th3-27/10/2015</span><span
                                        class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin">
                                            Admin</a></span></div>
                            </div>
                        </div>
                        <div class="news-post line-bottom small-post">
                            <div class="news-post-content">
                                <h3 class="post-title title"><a class="news-post-link" href="./single.html">Lorem Ipsum
                                        là gì, Tại sao lại sử dụng nó?</a></h3>
                                <div class="post-meta-container"><span class="post-meta-item"><i
                                            class="far fa-clock"></i> Th3-27/10/2015</span><span
                                        class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin">
                                            Admin</a></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="list-post-aside">
                        <h3 class="module-title"><a href="#">Liên kết website</a></h3>
                        <ul class="list-categories">
                            <li><a href="https://vinacomin.vn"><i class="material-icons list-style">chevron_right</i>Tập
                                    Đoàn CN Than - KSản VN</a></li>
                            <li><a href="https://ratraco.vn/"><i class="material-icons list-style">chevron_right</i>CTy
                                    CP Vận Tải & TM RATRACO</a></li>
                        </ul>
                    </div><a class="banner-add" href="#banner"><img
                            src="http://adi.admicro.vn/adt/adn/2018/10/300x2-adx5bd33c405c632.jpg"
                            alt="banner title" /></a><a class="banner-add" href="#banner"><img
                            src="http://adi.admicro.vn/adt/adn/2018/10/300x2-adx5bb48fba328c6.jpg"
                            alt="banner title" /></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_js')
@endsection
