@extends('site.layouts.main')
@section('content')
<div class="breadcrumb-wrapper">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb breadcrumb-dot">
                <li class="breadcrumb-item"><i class="material-icons">home</i><a href="{{ route('site.home.index') }}"
                        title="Trang chủ">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('site.home.category', $category->slug) }}" title="Title link">{{ $category->name }}</a></li>
                <li class="breadcrumb-item active"><span>{{ $data->title }}</span></li>
            </ol>
        </div>
    </div>
</div>
<div class="section-main">
    <div class="container main-wrapper">
        <h1 class="page-title"><a href="#">{{ $data->title }}</a></h1>
        <div class="row">
            <div class="col-sm-9 border-sm-right">
                <div class="row main-head">
                    <div class="col-sm-8 border-sm-right">
                      <div><br>
                        <div class="slide-owl-carousel owl-carousel owl-theme">
                          <div class="landscape_image"><img src="{{ $data->img }}" alt="{{ $data->title }}"/></div>
                          {{-- <div class="landscape_image"><img src="./assets/images/slide_01.jpg" alt="Tin 2 Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp"/></div>
                          <div class="landscape_image"><img src="./assets/images/slide_01.jpg" alt="Tin 3 Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp"/></div> --}}
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4"><br>
                      <div class="row">
                        <ul class="list-head">
                          <li><span class="title" href="#">Giá:</span><span>{{ number_format($data->price, 0,",",".") }}đ</span></li>
                          <li><span class="title" href="#">Diện tích:</span><span>{{ number_format($data->acreage, 0,",",".") }} m2</span></li>
                          <li><span class="title" href="#">Loại hình:</span><span>{{ $data->type_name }}</span></li>
                          <li><span class="title" href="#">Hướng:</span><span>{{ $data->direction }}</span></li>
                          <li><span class="title" href="#">Địa chỉ:</span><span>1{{ $data->address }}</span></li>
                          <li><span class="title">Phường/Xã:</span><span>{{ isset($arrWard[$data->ward_id]) ? $arrWard[$data->ward_id] : '--'  }}</span></li>
                          <li><span class="title">Quận/Huyện:</span><span>{{ isset($arrDistrict[$data->district_id]) ? $arrDistrict[$data->district_id] : '--'  }}</span></li>
                          <li><span class="title">Tỉnh/TP:</span><span>{{ isset($arrProvince[$data->province_id]) ? $arrProvince[$data->province_id] : '--'  }}</span></li>
                          <li><span class="title">Ngày đăng:</span><span><i class="far fa-clock"></i> {{ $data->created_at->format('d/m/Y') }}</span></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="detail-post">
                    <div class="news-post">
                      <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i> {{ $data->created_at->format('d/m/Y') }}</span><span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin"> {{ $data->user_name_c != '' ? $data->user_name_c : $data->admin_name_c }}</a></span></div>
                      <div class="post-sapo">{!! $data->short_description !!}</div>
                      <div class="news-post-content">
                        {!! $data->description !!}
                        <div class="pull-right"><strong>{{ $data->user_name_c != '' ? $data->user_name_c : $data->admin_name_c }}</strong></div>
                      </div>
                    </div>
                  </div>
                  <div class="list-post-aside"></div>
                  @if(sizeof($relate) > 0)
                  <h3 class="module-title"><a href="#">Dự án Liên quan</a></h3>
                  @foreach($relate as $v)
                  <div class="news-post line-bottom small-post"><a class="news-post-image-link" href="{{ route('site.home.showDetail',['slugCategory' => $category->slug, 'slugDetail' => $v->slug]) }}">
                      <figure class="image-container">
                      <div class="featured-image-overlay"><span class="featured-image-icon"><i class="fa fa-camera"></i></span></div><img class="img-responsive" src="{{ $v->img }}" alt="title alt"/>
                      </figure></a>
                    <div class="news-post-content">
                      <h3 class="post-title title"><a class="news-post-link" href="{{ route('site.home.showDetail',['slugCategory' => $category->slug, 'slugDetail' => $v->slug]) }}">{{ $v->title }}</a></h3>
                      <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i> {{ $data->created_at->format('d/m/Y') }}</span><span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin"> {{ $data->user_name_c != '' ? $data->user_name_c : $data->admin_name_c }}</a></span></div>
                    </div>
                  </div>
                  @endforeach
                  @endif
            </div>
            <div class="col-sm-3 sidebar">
                @include('site.layouts.sidebar')
            </div> <!-- sidebar -->
        </div>
    </div>
</div>

@endsection
