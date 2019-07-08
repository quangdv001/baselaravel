@extends('site.layout.main')
@section('title')
Trang chủ
@endsection
@section('content')
@if(sizeof($tour) > 0)
<div class="section section-lightblue">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-sm-12">
                <div class="text-left">
                    <div class="block-title underline">
                        <h2 class="title solid-color"><span>Địa điểm du lịch</span></h2>
                    </div>
                </div>
                <div class="slide-posts">
                    <div class="pro-services-carousel owl-carousel owl-theme">
                        @foreach($tour as $v)
                        @if($v->title)
                        <div class="block gray-block">
                            <div class="cover-image landscape-image"><img
                                    src="{{ $v->img }}" alt="" />
                            </div>
                            <div class="title">
                                <h3><a href="{{ route('site.article.detail', ['id' => $v->id, 'slug' => $v->slug]) }}">{{ $v->title }}</a></h3>
                            </div>
                            <p>{!! $v->short_description !!}</p><a
                          class="readmore" href="{{ route('site.article.detail', ['id' => $v->id, 'slug' => $v->slug]) }}"> <span>Xem chi tiết</span></a>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<div class="section section-about section-brand">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-sm-12">
                <div class="text-center">
                    <div class="block-title underline">
                        <h2 class="title solid-color text-uppercase"><span>Giới thiệu</span></h2>
                    </div>
                    <div class="subtitle">về Livitrans</div>
                </div>
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="feature-box-layout">
                            <div class="feature-box">
                                <div class="feature-box-icon">
                                    <div class="icons icon-diamond"></div>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="feature-title">Giới thiệu</h4>
                                    <p class="mb-4">Với bề dầy hoạt động 10 năm, Livitrans luôn là sự tin cậy của mọi
                                        khách hàng và đối tác. Bởi lẽ, dịch vụ không ngừng hoàn thiện để hài lòng khách
                                        hàng là con đường thành công của chúng tôi.</p>
                                </div>
                            </div>
                            <div class="feature-box">
                                <div class="feature-box-icon">
                                    <div class="icons icon-share"></div>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="feature-title">Phương trâm</h4>
                                    <p class="mb-4">Sau thời gian nâng cấp dịch vụ, hoàn chỉnh các quy trình phục vụ và
                                        đầu tư mới cơ sở vật chất, chúng tôi tự tin trở lại với quý khách hàng yêu quý
                                        với một diện mạo mới.</p>
                                </div>
                            </div>
                            <div class="feature-box">
                                <div class="feature-box-icon">
                                    <div class="icons icon-mission"></div>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="feature-title">Mong muốn</h4>
                                    <p class="mb-4">Và chính thức từ tháng 10 năm 2017, chúng tôi sẵn sàng đưa vào hoạt
                                        động đoàn tàu Du lịch chất lượng 4 sao với chất lượng vượt trội dành cho quý
                                        khách.</p>
                                    <p class="mb-4">Ban điều hành Công ty chúng tôi xin trân trọng gửi tới quý khách
                                        hàng và đối tác lời chúc tốt đẹp nhất thông qua chất lượng dịch vụ của mình.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/B4DxGWddOrE?rel=0"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section section-dark section-brand">
    <div class="container">
        <div class="row align-items-center cover-slide justify-content-md-center">
            <div class="col-sm-12">
                <div class="text-center">
                    <div class="block-title underline">
                        <h2 class="title"><span>Dịch vụ</span></h2>
                    </div>
                </div>
                <div class="row services-blog">
                    <div class="col-12 col-sm-4"><a class="block service-blog text-center active" href="./single.html">
                            <div class="cover-icon"><i class="flaticon-train-1"></i>
                            </div>
                            <div class="title">
                                <h3><span>ĐẶT VÉ</span></h3>
                            </div>
                            <p>Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn
                                trang phục vụ cho in ấn.</p><span class="readmore" href="#0"> <span>Xem chi
                                    tiết</span></span>
                        </a>
                    </div>
                    <div class="col-12 col-sm-4"><a class="block service-blog text-center" href="./single.html">
                            <div class="cover-icon"><i class="flaticon-travel"></i>
                            </div>
                            <div class="title">
                                <h3><span>KÝ GỬI</span></h3>
                            </div>
                            <p>Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn
                                trang phục vụ cho in ấn.</p><span class="readmore" href="#0"> <span>Xem chi
                                    tiết</span></span>
                        </a>
                    </div>
                    <div class="col-12 col-sm-4"><a class="block service-blog text-center" href="./single.html">
                            <div class="cover-icon"><i class="flaticon-tram"></i>
                            </div>
                            <div class="title">
                                <h3><span>CÁP TREO</span></h3>
                            </div>
                            <p>Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn
                                trang phục vụ cho in ấn.</p><span class="readmore" href="#0"> <span>Xem chi
                                    tiết</span></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(sizeof($article) > 0)
<div class="section section-hotnews">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-sm-12">
                <div class="text-left">
                    <div class="block-title underline">
                        <h2 class="title solid-color text-uppercase"><span>Tin mới</span></h2>
                    </div>
                    <div class="block-view-more pull-right"><a class="view-more" href="#">Xem thêm <i
                                class="fa fa-angle-double-right"></i></a></div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($article as $v)
              @if($v->title)
              <div class="col-12 col-sm-6 grid-news">
                  <div class="news-post"><a class="news-post-image-link" href="./single.html">
                          <figure class="image-container rectangle-image">
                              <div class="featured-image-overlay"><span class="featured-image-icon"><i
                                          class="fa fa-camera"></i></span></div><img class="img-responsive"
                                  src="{{ $v->img }}" alt="title alt" />
                          </figure>
                      </a>
                      <div class="news-post-content">
                          <h2 class="post-title title"><a class="news-post-link" href="{{ route('site.article.detail', ['id' => $v->id, 'slug' => $v->slug]) }}">{{ $v->title }}</a></h2>
                          <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i>
                                  {{ $v->created_at->format('d/m/Y') }}</span><span class="post-meta-item"><i class="fa fa-user-check"></i><a
                                      href="#admin"> Admin</a></span></div>
                          <p class="post-desc">{!! $v->short_description !!}
                          </p><a class="read-more-button" href="{{ route('site.article.detail', ['id' => $v->id, 'slug' => $v->slug]) }}">Xem tiếp...</a>
                      </div>
                  </div>
              </div>
              @endif
            @endforeach
        </div>
    </div>
</div>
@endif
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
                beforeSend: function () {
                    $('.has-spinner').buttonLoader('start');
                },
                success: function (res) {
                    $('.has-spinner').buttonLoader('stop');
                    if (res.success == 1) {
                        init.notyPopup(res.mess, 'success');
                    } else {
                        init.notyPopup('Có lỗi xảy ra', 'error');
                    }
                },
                error: function (res) {
                    $('.has-spinner').buttonLoader('stop');
                    init.notyPopup('Có lỗi xảy ra', 'error');
                }
            });

        });
    })

</script>
@endsection
