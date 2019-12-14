@extends('site.layout.main')
@section('title')
{{ $article->title }}
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
            <li class="breadcrumb-item"><a href="{{ route('site.article.index', ['slug' => Str::slug($article->category->name, '-'), 'id' => $article->category->id]) }}" title="Title link">{{ $article->category->name }}</a></li>
            <li class="breadcrumb-item active"><span>{{ $article->title }}</span></li>
          </ol>
        </div>
      </div>
    </div>
    <div class="section-main">
      <div class="container main-wrapper">        
        <h1 class="page-title"><a href="#">{{ $article->title }}</a></h1>
        <div class="row">
          <div class="col-sm-9 border-sm-right">
            <div class="detail-post">
              <div class="news-post">
                <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i> {{ $article->created_at->format('d/m/Y') }}</span><span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin"> {{ $article->user_name_c ? $article->user_name_c : $article->admin_name_c }}</a></span></div>
                <div class="post-sapo">{!! $article->short_description !!}</div>
                <div class="news-post-content">
                  {!! $article->description !!}
                  <div class="pull-right"><strong>{{ $article->user_name_c ? $article->user_name_c : $article->admin_name_c }}</strong></div>
                </div>
              </div>
            </div>
            <div class="list-post-aside"></div>
            @if(sizeof($relate) > 0)
            <h3 class="module-title"><a href="#">Tin Liên quan</a></h3>
            @foreach($relate as $v) 
            <div class="news-post line-bottom list-style-post small-post">
              <div class="news-post-content">
                <div class="post-title title"><i class="list-icon fas fa-circle"></i><a class="news-post-link" href="{{ route('site.article.detail', ['slug' => Str::slug($v->title, '-'), 'id' => $v->id]) }}">{{ $v->title }}</a></div>
              </div>
            </div>
            @endforeach
            @endif
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
