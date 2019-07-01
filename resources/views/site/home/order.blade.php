@extends('site.layout.main')
@section('title')
Kiểm tra đơn hàng
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
                        <a class="block service-blog text-center active" href="{{ strval($v->url) != '' ? url(strval($v->url)) : '#' }}">
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
<div class="main">
        <div class="section section-subpage">
          <div class="container">
            <div class="text-center">
              <div class="block-title underline">
                <h1 class="title solid-color text-uppercase"><span>Quản lý đơn hàng của bạn</span></h1>
              </div>
            </div>
            <div class="row">
              <div class="col-md-5">
                <div class="form tracking_form">
                  <div class="row">
                      <form action="{{ route('site.home.detail') }}">
                    <div class="col-12">
                      <label>Vui lòng nhập mã đơn hàng để có thể xem chi tiết</label>
                    </div>

                        <div class="col-12 form-group relative-panel">
                          <input class="form-control" placeholder="Nhập mã đơn hàng..." name="id">
                          <button class="btn btn-primary btn-submit" type="submit">Kiểm tra</button>
                        </div>
                    </div>
                    </form>
                </div>
              </div>
              <div class="col-12">
                <div class="tracking-panel row">
                  <div class="col-md-4">
                    <div class="row">
                      <div class="tracking-item-wrapper">
                        <div class="tracking-item "><img class="tracking-item-img" src="{{ asset('public/assets/site/themes/assets/images/tracking-1_active.png') }}" alt="">
                          <div class="tracking-item-content">Bắt đầu thực hiện hợp đồng</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="row">
                      <div class="tracking-item-wrapper">
                        <div class="tracking-item "><img class="tracking-item-img" src="{{ asset('public/assets/site/themes/assets/images/tracking-2.png') }}" alt="">
                          <div class="tracking-item-content">Đơn hàng đang trong quá trình sản xuất</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="row">
                      <div class="tracking-item-wrapper">
                        <div class="tracking-item "><img class="tracking-item-img" src="{{ asset('public/assets/site/themes/assets/images/tracking-3.png') }}" alt="">
                          <div class="tracking-item-content">Đơn hàng đang giao đến quý khách</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
@section('custom_js')

@endsection
