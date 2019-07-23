@extends('site.layout.main')
@section('title')
{{ $cate->name }}
@endsection
@section('content')
<div class="main">
    <div class="subpage-cover"
        style="background: #2d71a2 url({{ asset('public/assets/site/themes/assets/images/subpage-cover.jpg') }}) no-repeat center top/ auto 100%">
        <div class="page-title d-flex align-items-center justify-content-center"><span>{{ $cate->name }}</span>
        </div>
    </div>
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <ol class="breadcrumb breadcrumb-dot">
                    <li class="breadcrumb-item"><i class="material-icons">home</i><a href="index.html"
                            title="Trang chủ">@lang('header.home')</a></li>
                    <li class="breadcrumb-item active"><span>{{ $cate->name }}</span></li>
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
                            <h1 class="page-title"><a href="#">{{ $cate->name }}</a></h1>
                            @if(sizeof($data) > 0)
                            <div class="col">
                                <div class="list-post row">
                                    @foreach($data as $v)
                                    @if($v->title)
                                    <div class="news-post line-bottom"><a class="news-post-image-link"
                                            href="{{ route('site.article.detail', ['id' => $v->id, 'slug' => $v->slug]) }}">
                                            <figure class="image-container rectangle-image">
                                                <div class="featured-image-overlay"><span class="featured-image-icon"><i
                                                            class="fa fa-camera"></i></span></div><img
                                                    class="img-responsive"
                                                    src="{{ $v->img }}"
                                                    alt="title alt" />
                                            </figure>
                                        </a>
                                        <div class="news-post-content">
                                            <h2 class="post-title title"><a class="news-post-link"
                                            href="{{ route('site.article.detail', ['id' => $v->id, 'slug' => $v->slug]) }}">{{ $v->title }}</a></h2>
                                            <div class="post-meta-container"><span class="post-meta-item"><i
                                                        class="far fa-clock"></i> {{ $v->created_at->format('d/m/Y') }}</span><span
                                                    class="post-meta-item"><i class="fa fa-user-check"></i><a
                                                        href="#admin"> Admin</a></span></div>
                                            <p class="post-desc">{!! $v->short_description !!}
                                            </p><a class="read-more-button" href="{{ route('site.article.detail', ['id' => $v->id, 'slug' => $v->slug]) }}">Xem tiếp...</a>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            <nav aria-label="Page navigation">
                                {{ $data->links() }}
                            </nav>
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
