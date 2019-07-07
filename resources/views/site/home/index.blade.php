@extends('site.layout.main')
@section('title')
Trang chủ
@endsection
@section('content')
<div class="section-dark"
style="background: #ccc url({{ asset('public/assets/site/themes/assets/images/slide-bg.png') }}) center top /auto 100%;margin-bottom: 15px;">
    <div class="container">
        <div class="row align-items-center cover-slide justify-content-md-center">
            <div class="col-sm-12">
                <div class="text-center">
                    <div class="block-title">
                        <h2 class="title sevices-title-nomarl"><span>KHÔNG GIAN SỐNG LÀ ĐẦU TƯ NỀN TẢNG</span></h2>
                    </div>
                    <div class="sevices-title-large">CHO NHỮNG THÀNH CÔNG NỐI TIẾP VỀ SAU</div>
                </div>
                @if(sizeof($category) > 0)
                <div class="row services-blog">
                    @foreach($category as $v)
                    @if($v->type == 0)
                    <div class="col-12 col-sm-3">
                        <a class="block service-blog text-center" href="{{ strval($v->url) != '' ? url(strval($v->url)) : '#' }}">
                            <div class="cover-icon"><img src="{{ $v->img }}" alt=""/>
                            </div>
                            <div class="title">
                              <h3><span>{{ $v->name }}</span></h3>
                            </div></a>
                        </div>
                    @elseif($v->type == 1)
                    <div class="col-12 col-sm-3">
                            <a class="block service-blog text-center" href="{{ route('site.article.index',['id' => $v->id, 'slug' => $v->slug]) }}">
                                <div class="cover-icon"><img src="{{ $v->img }}" alt=""/>
                                </div>
                                <div class="title">
                                  <h3><span>{{ $v->name }}</span></h3>
                                </div></a>
                            </div>
                    @elseif($v->type == 2)
                    <div class="col-12 col-sm-3">
                            <a class="block service-blog text-center" href="{{ route('site.product.list',['id' => $v->id, 'slug' => $v->slug]) }}">
                                <div class="cover-icon"><img src="{{ $v->img }}" alt=""/>
                                </div>
                                <div class="title">
                                  <h3><span>{{ $v->name }}</span></h3>
                                </div></a>
                            </div>
                    @elseif($v->type == 3)
                    <div class="col-12 col-sm-3">
                            <a class="block service-blog text-center" href="{{ route('site.article.list',['id' => $v->id, 'slug' => $v->slug]) }}">
                                <div class="cover-icon"><img src="{{ $v->img }}" alt=""/>
                                </div>
                                <div class="title">
                                  <h3><span>{{ $v->name }}</span></h3>
                                </div></a>
                            </div>
                    @endif

                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-sm-12">
                <div class="text-left">
                    <div class="block-title underline">
                        <h2 class="title solid-color text-uppercase"><span>Về chúng tôi</span></h2>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-sm-7">
                        <div class="feature-box-layout">
                            <div class="feature-box">
                                <div class="feature-box-icon">
                                    <div class="icons icon-mission"></div>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="feature-title">Giới thiệu</h4>
                                    <p class="mb-4">Công ty TNHH Nội thất Đại Dương với tên giao dịch quốc tế là Ocean
                                        Furniture Co., Ltd, được thành lập từ năm 2003. Trải qua 15 năm phát triển,
                                        Ocean Furniture đã trở thành một trong những thương hiệu nổi tiếng trong ngành
                                        kinh doanh, nhập khẩu, thiết kế, sản xuất, thi công lắp đặt đồ nội thất, được
                                        nhiều cá nhân và tổ chức biết đến. Đến nay, sản phẩm của công ty đã có mặt trong
                                        rất nhiều dự án, công trình lớn nhỏ trên cả nước.</p>
                                </div>
                            </div>
                            <div class="feature-box">
                                <div class="feature-box-icon">
                                    <div class="icons icon-share"></div>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="feature-title">Phương trâm</h4>
                                    <p class="mb-4">Với phương châm “Tất cả cho khách hàng, khách hàng cho tất cả”, lấy
                                        khách hàng làm nền tảng cho mọi hoạt động, đáp ứng hoàn hảo nhu cầu của khách
                                        hàng cho một cuộc sống chất lượng, Ocean Furniture không chỉ đặt chất lượng sản
                                        phẩm và xu thế thời thượng lên hàng đầu, mà còn đặc biệt chú trọng đến các dịch
                                        vụ đi kèm sau bán hàng như chăm sóc khách hàng, bảo hành, bảo trì.</p>
                                </div>
                            </div>
                            <div class="feature-box">
                                <div class="feature-box-icon">
                                    <div class="icons icon-diamond"></div>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="feature-title">Mong muốn</h4>
                                    <p class="mb-4">Chúng tôi luôn mong muốn Ocean Furniture là thương hiệu mà khách
                                        hàng sẽ nhớ đến kèm theo một chuẩn mực nhất định. Đó là sự hài lòng cao nhất của
                                        khách hàng.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5"><a href="#"><img src="{{ asset('public/assets/site/themes/assets/images/about.jpg') }}" alt=""></a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(sizeof($cate) > 0)
@foreach($cate as $v)

<div class="section">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-sm-12">
                <div class="text-left bottom-line">
                    <div class="block-title underline">
                        <h2 class="title solid-color text-uppercase"><span>Dự án đã {{ $v->name }}</span></h2>
                    </div>
                    <div class="block-view-more pull-right"><a class="view-more"
                            href="{{ route('site.article.index',['id' => $v->id, 'slug' => $v->slug]) }}">Xem thêm <i
                                class="fa fa-angle-double-right"></i></a></div>
                </div>
                @if(sizeof($v->article) > 0)
                <div class="slide-posts">
                    <div class="pro-services-carousel owl-carousel owl-theme">
                        @foreach($v->article as $item)
                        <div class="block gray-block">
                            <div class="cover-image square-image">
                                <a href="{{ route('site.article.detail',['id' => $item->id, 'slug' => $item->slug]) }}">
                                    <img src="{{ $item->img }}" alt="{{ $item->title }}" />
                                </a>
                            </div>
                            <div class="title">
                                <h3><a
                                        href="{{ route('site.article.detail',['id' => $item->id, 'slug' => $item->slug]) }}">Dự
                                        án {{ $item->title }}</a></h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach
@endif
<div class="section">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-sm-12">
                <div class="text-center">
                    <div class="block-title underline">
                        <h2 class="title solid-color text-uppercase"><span>Đối tác của chúng tôi</span></h2>
                    </div>
                </div>
                <div class="partners">
                    <div class="partners-carousel owl-carousel owl-theme">
                        <a class="partner-item" href="#partner"><img
                                src="{{ asset('public/assets/site/themes/assets/images/partners/p1.jpg') }}"
                                alt="#{i}" />
                        </a>
                        <a class="partner-item" href="#partner"><img
                                src="{{ asset('public/assets/site/themes/assets/images/partners/p1.jpg') }}"
                                alt="#{i}" />
                        </a>
                        <a class="partner-item" href="#partner"><img
                                src="{{ asset('public/assets/site/themes/assets/images/partners/p1.jpg') }}"
                                alt="#{i}" />
                        </a>
                        <a class="partner-item" href="#partner"><img
                                src="{{ asset('public/assets/site/themes/assets/images/partners/p1.jpg') }}"
                                alt="#{i}" />
                        </a>
                        <a class="partner-item" href="#partner"><img
                                src="{{ asset('public/assets/site/themes/assets/images/partners/p1.jpg') }}"
                                alt="#{i}" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section section-contact">
    <div class="container">
        <div class="row justify-content-md-center align-items-center">
            <div class="col-sm-6">
                <div class="text-center text-uppercase">
                    <div class="block-title">
                        <h2 class="title solid-color"><span>Nếu bạn có bất kỳ câu hỏi nào</span></h2>
                    </div>
                    <div class="subtitle">Hãy liên hệ với chúng tôi</div>
                </div>
            </div>
            <div class="col-sm-6">
                <form action="" class="form-contact">
                    <div class="form contact_form custom-form">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <input class="form-control" placeholder="Họ tên" name="name">
                            </div>
                            <div class="col-sm-6 form-group">
                                <input class="form-control" placeholder="Số điện thoại" name="phone">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <input class="form-control" placeholder="Email" name="email">
                            </div>
                            <div class="col-sm-6 form-group">
                                <input class="form-control" placeholder="Nội dung" name="content">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <button class="btn btn-secondary btn-submit has-spinner" data-load-text="Gửi" type='submit'>Gửi</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_js')
<script>
    $(document).ready(function () {
        $(".form-contact").submit(function (e) {
            
            //prevent Default functionality
            e.preventDefault();

            //get the action-url of the form
            var actionurl = BASE_URL + '/sendContact';

            //do your own request an handle the results
            $.ajax({
                url: actionurl,
                type: 'post',
                // dataType: 'application/json',
                data: $(".form-contact").serialize(),
                beforeSend: function() {
                    $('.has-spinner').buttonLoader('start');
                },
                success: function (res) {
                    $('.has-spinner').buttonLoader('stop');
                    if(res.success == 1){
                        init.notyPopup(res.mess, 'success');
                    } else {
                        init.notyPopup('Có lỗi xảy ra', 'error');
                    }
                },
                error: function(res){
                    $('.has-spinner').buttonLoader('stop');
                    init.notyPopup('Có lỗi xảy ra', 'error');
                }
            });

        });
    })

</script>
@endsection
