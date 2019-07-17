@extends('site.layout.main')
@section('title')
{{ $data->title }}
@endsection
@section('content')
<div class="main">
    <div class="subpage-cover"
        style="background: #2d71a2 url({{ asset('public/assets/site/themes/assets/images/subpage-cover.jpg') }}) no-repeat center top/ auto 100%">
        <div class="page-title d-flex align-items-center justify-content-center"><span>{{ $data->title }}?</span></div>
    </div>
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <ol class="breadcrumb breadcrumb-dot">
                    <li class="breadcrumb-item"><i class="material-icons">home</i><a
                            href="{{ route('site.home.index' )}}" title="Trang chủ">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('site.article.index', ['id' => $cate->id, 'slug' => $cate->slug]) }}"
                            title="Title link">{{ $cate->name }}</a></li>
                    <li class="breadcrumb-item active"><span>{{ $data->title }}</span></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="section-main">
        <div class="container">
            <div class="row">
                <div class="col col-sm-9 border-sm-right">
                    <div class="row">
                        <div class="col">
                            <div class="detail-post">
                                <h1 class="page-title"><a href="#">{{ $data->title }}</a></h1>
                                <div class="news-post">
                                    <div class="post-meta-container"><span class="post-meta-item"><i
                                                class="far fa-clock"></i>
                                            {{ $data->created_at->format('d/m/Y') }}</span><span
                                            class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin">
                                                Admin</a></span></div>
                                    <div class="post-sapo">{!! $data->short_description !!}</div>
                                    <div class="news-post-content">
                                        {!! $data->description !!}
                                        <div class="pull-right"><strong>livitrans</strong></div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="list-post-aside">
                  <h3 class="module-title"><a href="#">Tin Liên quan</a></h3>
                  <div class="news-post line-bottom list-style-post small-post">
                    <div class="news-post-content">
                      <div class="post-title title"><i class="list-icon fas fa-circle"></i><a class="news-post-link" href="/single.html">Lorem Ipsum là gì, Tại sao lại sử dụng nó?</a></div>
                    </div>
                  </div>
                  <div class="news-post line-bottom list-style-post small-post">
                    <div class="news-post-content">
                      <div class="post-title title"><i class="list-icon fas fa-circle"></i><a class="news-post-link" href="/single.html">Lorem Ipsum là gì, Tại sao lại sử dụng nó?</a></div>
                    </div>
                  </div>
                  <div class="news-post line-bottom list-style-post small-post">
                    <div class="news-post-content">
                      <div class="post-title title"><i class="list-icon fas fa-circle"></i><a class="news-post-link" href="/single.html">Lorem Ipsum là gì, Tại sao lại sử dụng nó?</a></div>
                    </div>
                  </div>
                  <div class="news-post line-bottom list-style-post small-post">
                    <div class="news-post-content">
                      <div class="post-title title"><i class="list-icon fas fa-circle"></i><a class="news-post-link" href="/single.html">Lorem Ipsum là gì, Tại sao lại sử dụng nó?</a></div>
                    </div>
                  </div>
                  <div class="news-post line-bottom list-style-post small-post">
                    <div class="news-post-content">
                      <div class="post-title title"><i class="list-icon fas fa-circle"></i><a class="news-post-link" href="/single.html">Lorem Ipsum là gì, Tại sao lại sử dụng nó?</a></div>
                    </div>
                  </div>
                </div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 sidebar">
                    <div class="list-post-aside">
                        <h3 class="module-title"><a href="#">Danh mục</a></h3>
                        <ul class="list-categories">
                            <li><a href="#link"><i class="material-icons list-style">chevron_right</i>Đặt vé</a></li>
                            <li><a href="#link"><i class="material-icons list-style">chevron_right</i>Du lịch</a></li>
                            <li><a href="#link"><i class="material-icons list-style">chevron_right</i>Hủy chuyến</a>
                            </li>
                            <li><a href="#link"><i class="material-icons list-style">chevron_right</i>Gửi hành lý</a>
                            </li>
                            <li><a href="#link"><i class="material-icons list-style">chevron_right</i>Ký gửi</a></li>
                        </ul>
                    </div>
                    @if(sizeof($relateArticle) > 0)
                    <div class="list-post-aside">
                        <h3 class="module-title"><a href="#">{{ $cate->name }} nổi bật</a></h3>
                        @foreach($relateArticle as $v)
                        @if($v->title)
                        <div class="news-post line-bottom small-post"><a class="news-post-image-link"
                                href="{{ route('site.article.detail', ['id' => $v->id, 'slug' => $v->slug]) }}">
                                <figure class="image-container rectangle-image">
                                    <div class="featured-image-overlay"><span class="featured-image-icon"><i
                                                class="fa fa-camera"></i></span></div><img class="img-responsive"
                                        src="{{ $v->img }}" alt="title alt" />
                                </figure>
                            </a>
                            <div class="news-post-content">
                                <h3 class="post-title title"><a class="news-post-link"
                                        href="{{ route('site.article.detail', ['id' => $v->id, 'slug' => $v->slug]) }}">{{ $v->title }}</a>
                                </h3>
                                <div class="post-meta-container"><span class="post-meta-item"><i
                                            class="far fa-clock"></i> {{ $v->created_at->format('d/m/Y') }}</span><span
                                        class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin">
                                            Admin</a></span></div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endif
                    {{-- <a class="banner-add" href="#banner"><img src="http://adi.admicro.vn/adt/adn/2018/10/300x2-adx5bd33c405c632.jpg" alt="banner title"/></a><a class="banner-add" href="#banner"><img src="http://adi.admicro.vn/adt/adn/2018/10/300x2-adx5bb48fba328c6.jpg" alt="banner title"/></a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_js')
@endsection
