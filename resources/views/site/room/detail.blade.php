@extends('site.layout.main')
@section('title')
{{ $room->title }}
@endsection
@section('class_page')
category
@endsection
@section('content')
<div class="main">
  <div class="breadcrumb-wrapper">
    <div class="container">
      <div class="row">
        <ol class="breadcrumb breadcrumb-dot">
          <li class="breadcrumb-item"><i class="material-icons">home</i><a href="{{ route('site.home.index') }}" title="Trang chủ">Trang chủ</a></li>
          <li class="breadcrumb-item"><a href="{{ route('site.article.index', ['slug' => Str::slug($room->category->name, '-'), 'id' => $room->category->id]) }}" title="Title link">Sub page</a></li>
          <li class="breadcrumb-item active"><span>{{ $room->title }}</span></li>
        </ol>
      </div>
    </div>
  </div>
  <div class="section-main">
    <div class="container main-wrapper">        
      <h1 class="page-title"><a href="#">{{ $room->title }}</a></h1>
      <div class="row">
        <div class="col-sm-9 border-sm-right">
          <div class="row main-head">
            <div class="col-sm-8 border-sm-right">
              <div><br>
                <div class="slide-owl-carousel owl-carousel owl-theme">
                  <div class="landscape_image"><img src="{{ $room->img }}" alt="Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp"/></div>
                  @if(sizeof($room->images) > 0)
                  @foreach($room->images as $image) 
                  <div class="landscape_image"><img src="{{ $image->img }}" alt="Tin 2 Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp"/></div>
                  @endforeach
                  @endif
                </div>
              </div>
            </div>
            <div class="col-sm-4"><br>
              <div class="row">
                <ul class="list-head">
                  <li><span class="title" href="#">Dự án:</span><span>{{ $room->project }}</span></li>
                  <li><span class="title" href="#">Diện tích:</span><span>{{ number_format($room->acreage) }} m2</span></li>
                  <li><span class="title" href="#">Loại hình:</span><span>{{ $room->name }}</span></li>
                  <li><span class="title" href="#">Hướng:</span><span>{{ $room->direction }}</span></li>
                  <li><span class="title" href="#">Địa chỉ:</span><span>{{ $room->address }}</span></li>
                  <li><span class="title">Huyện:</span><span>{{ $room->ward->name }}</span></li>
                  <li><span class="title">Quận:</span><span>{{ $room->district->name }}</span></li>
                  <li><span class="title">TP:</span><span>{{ $room->province->name }}</span></li>
                  <li><span class="title">Ngày đăng:</span><span><i class="far fa-clock"></i> {{ $room->created_at->format('d/m/Y') }}</span></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="detail-post">
            <div class="news-post">
              <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i>{{ $room->created_at->format('d/m/Y') }}</span><span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin"> {{ $room->user_name_c ? $room->user_name_c : $room->admin_name_c }}</a></span></div>
              <div class="post-sapo">{!! $room->short_description !!}</div>
              <div class="news-post-content">
                {!! $room->description !!}
              </div>
            </div>
          </div>
          <div class="list-post-aside"></div>
          @if(sizeof($relate) > 0) 
          <h3 class="module-title"><a href="#">Dự án Liên quan</a></h3>
          @foreach($relate as $v)
          <div class="news-post line-bottom small-post"><a class="news-post-image-link" href="{{ route('site.room.detail', ['slug' => Str::slug($v->title, '-'), 'id' => $v->id]) }}">
              <figure class="image-container">
                <div class="featured-image-overlay"><span class="featured-image-icon"><i class="fa fa-camera"></i></span></div><img class="img-responsive" src="{{ $v->img }}" alt="title alt"/>
              </figure></a>
            <div class="news-post-content">
              <h3 class="post-title title"><a class="news-post-link" href="{{ route('site.room.detail', ['slug' => Str::slug($v->title, '-'), 'id' => $v->id]) }}">{{ $v->title }}</a></h3>
              <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i> {{ $v->created_at->format('d/m/Y') }}</span><span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin"> {{ $v->user_name_c ? $v->user_name_c : $v->admin_name_c }}</a></span></div>
            </div>
          </div>
          @endforeach
          @endif
        </div>
        <div class="col-sm-3 sidebar">
            @widget('recentNews')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('custom_js')

@endsection
