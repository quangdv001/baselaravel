@extends('site.layout.main')
@section('title')
@lang('header.album_image')
@endsection
@section('content')
<div class="main">
    <div class="subpage-cover"
        style="background: #2d71a2 url({{ asset('public/assets/site/themes/assets/images/subpage-cover.jpg') }}) no-repeat center top/ auto 100%">
        <div class="page-title d-flex align-items-center justify-content-center"><span>@lang('header.album_image')</span></div>
    </div>
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <ol class="breadcrumb breadcrumb-dot">
                    <li class="breadcrumb-item"><i class="material-icons">home</i><a
                            href="{{ route('site.home.index' )}}" title="Trang chủ">@lang('header.home')</a></li>
                    <li class="breadcrumb-item active"><span>@lang('header.album_image')</span></li>
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
                      <h1 class="page-title"><a href="#">Album Ảnh Livitrans Express</a></h1>
                      <div class="news-post" style="max-width: 100%; overflow: hidden">
                        <!-- <div class="post-sapo">Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một văn bản chuẩn</div> -->
                        <div class="main-media">
                            @if(isset($images) && count($images) > 0)
                                @foreach($images as $k => $image)
                                <a class="item galleryItem" href="{{ $image->image }}" data-group="1" title="@if($locate == 'en') {{ $image->content_en }} @else {{ $image->content_vi }} @endif">
                                    <img src="{{ $image->image }}" alt="@if($locate == 'en') {{ $image->content_en }} @else {{ $image->content_vi }} @endif">
                                    <div class="media-caption">
                                    <!-- <h3>CABIN 4 GIƯỜNG - DELUXE (T)</h3> -->
                                    <p>@if($locate == 'en') {{ $image->content_en }} @else {{ $image->content_vi }} @endif</p>
                                    </div>
                                </a><br>
                                @endforeach
                            @else
                                <h3>Hiện tại chưa có nội dung cho mục này. Vui lòng quay lại sau!</h3>
                            @endif
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
