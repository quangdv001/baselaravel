@extends('site.layout.main')
@section('title')
Tìm kiếm
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
            {{-- <li class="breadcrumb-item"><a href="#sublink" title="Title link">Sub page</a></li> --}}
            <li class="breadcrumb-item active"><span>Tìm kiếm</span></li>
          </ol>
        </div>
      </div>
    </div>
    <div class="section-main">
      <div class="container main-wrapper">         
        <h1 class="page-title"><a href="#">{{ $title }}</a></h1>
        <div class="row">
          <div class="col-sm-9 border-sm-right">
            @if(sizeof($room) > 0)
            <div class="list-post">
              @foreach($room as $v) 
              
              <div class="forrent-post line-bottom">
                <div class="post-content"><a class="news-post-image-link" href="{{ route('site.room.detail', ['slug' => Str::slug($v->title, '-'), 'id' => $v->id]) }}">
                    <figure class="image-container">
                      <div class="featured-image-overlay"><span class="featured-image-icon"><i class="fa fa-camera"></i></span></div><img class="img-responsive" src="{{ $v->img }}" alt="title alt"/>
                    </figure></a>
                  <h3 class="post-title title"><a class="news-post-link" href="{{ route('site.room.detail', ['slug' => Str::slug($v->title, '-'), 'id' => $v->id]) }}">{{ $v->title }}</a></h3>
                  <div class="row">
                    <div class="col rent-attribute"><strong>Giá :</strong><span> {{ number_format($v->price) }} triệu</span></div>
                    <div class="col rent-attribute"><strong>Diện tích :</strong><span> {{ number_format($v->acreage) }} m²</span></div>
                    <div class="col rent-attribute"><strong>Quận/huyện :</strong><span> {{ $v->district->name }}</span></div>
                  </div>
                  <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i> {{ $v->created_at->format('d/m/Y') }}</span><span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin"> {{ $v->user_name_c ? $v->user_name_c : $v->admin_name_c }}</a></span></div>
                </div>
              </div>
              @endforeach
              
            </div>
            @endif
            <br>
            {{ $room->links() }}
            {{-- <nav aria-label="Page navigation">
              <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Trước</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Tiếp</a></li>
              </ul>
            </nav> --}}
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
