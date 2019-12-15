@extends('site.layout.main')
@section('title')
{{ $page->title }}
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
            {{-- <li class="breadcrumb-item"><a href="{{ route('site.article.index', ['slug' => Str::slug($page->category->name, '-'), 'id' => $page->category->id]) }}" title="Title link">{{ $page->category->name }}</a></li> --}}
            <li class="breadcrumb-item active"><span>{{ $page->title }}</span></li>
          </ol>
        </div>
      </div>
    </div>
    <div class="section-main">
      <div class="container main-wrapper">        
        <h1 class="page-title"><a href="#">{{ $page->title }}</a></h1>
        <div class="row">
          <div class="col-sm-9 border-sm-right">
            <div class="detail-post">
              <div class="news-post">
                <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i> {{ $page->created_at->format('d/m/Y') }}</span><span class="post-meta-item"></span></div>
                {{-- <div class="post-sapo">{!! $page->short_description !!}</div> --}}
                <div class="news-post-content">
                  {!! $page->description !!}
                  <div class="pull-right"><strong>{{ $page->user_name_c ? $page->user_name_c : $page->admin_name_c }}</strong></div>
                </div>
              </div>
            </div>
            <div class="list-post-aside"></div>
          </div>
          <div class="col-sm-3 sidebar">
              @widget('recent_news')
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('custom_js')

@endsection
