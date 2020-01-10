@extends('site.layout.main')
@section('title')
Trang chủ
@endsection
@section('class_page')
home
@endsection
@section('content')
<div class="main">
    <div class="section-main">
        <div class="container main-wrapper">
            <div class="row">
                <div class="col-sm-9 border-sm-right">
                    <div class="row main-head">
                        <div class="col-sm-3 border-sm-right">
                            <div class="block-title underline">
                                <h2 class="title solid-color text-uppercase"><span>Nhà đất hà nội</span></h2>
                            </div>
                            <div class="row">
                                <ul class="list-head">
                                @if (count($list_article_lands) > 0)
                                    @foreach ($list_article_lands as $key_lands=>$item_lands)
                                        <li><a class="title" href="{{ route('site.article.detail', ['slug' => Str::slug($item_lands->title, '-'), 'id' => $item_lands->id]) }}"><span><i
                                                        class="far fa-clock"></i></span><span>&nbsp;{{ $item_lands->title }}</span></a></li>
                                    @endforeach
                                @else
                                    <li><a class="title" href="javascript:void(0)">Không có bài viết</a></li>
                                @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-9">
                        @if (count($list_article_laws) > 0)
                            <div class="row">
                                <div class="slide-owl-carousel owl-carousel owl-theme">
                                @foreach ($list_article_laws as $key_laws=>$item_laws)
                                    @if ($key <= 2)
                                        <a class="block" href="{{ route('site.article.detail', ['slug' => Str::slug($item_laws->title, '-'), 'id' => $item_laws->id]) }}">
                                            <div class="cover-item">
                                                <div class="landscape_image"><img alt="{{ $item_laws->title }}" src="{{ $item_laws->img}}" />
                                                </div>
                                            </div>
                                            <div class="detail-item">
                                                <div class="title">{{ $item_laws->title }}</div>
                                                <div class="meta-info">
                                                    <span class="meta-info-item"><i class="far fa-clock"></i> {{$item_laws->created_at->diffForHumans() }}</span>
                                                </div>
                                                <div class="short-description">>@if (strlen(strip_tags($item_laws->short_description)) > 100) {!! mb_substr(strip_tags($item_laws->short_description), 0, mb_strpos(strip_tags($item_laws->short_description), ' ', 100)) !!}... @else {!! $item_laws->short_description !!} @endif</div>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <ul class="list-head">
                                @foreach ($lastestLaws as $key_laws=>$item_laws)
                                    @if ($key > 2)
                                        <li>
                                            <a class="title" href="{{ route('site.article.detail', ['slug' => Str::slug($item_laws->title, '-'), 'id' => $item_laws->id]) }}">
                                            @if (strlen(strip_tags($item_laws->title)) > 150) {!! mb_substr(strip_tags($item_laws->title), 0, mb_strpos(strip_tags($item_laws->title), ' ', 150)) !!}... @else {!! $item_laws->title !!} @endif
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                                </ul>
                            </div>
                            @else
                                <h3 class="module-title"><a href="#">PHÁP LÝ</a></h3>
                                <div class="content">Không có bài viết</div>
                        @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 border-sm-right">
                            <div class="block">
                                <div class="block-title underline">
                                    <h2 class="title solid-color text-uppercase"><span>Tin cho thuê</span></h2>
                                </div>
                                <div class="list-post">
                                @if (count($list_article_rooms) > 0)
                                    @foreach ($list_article_rooms as $key_room=>$item_room)
                                        <div class="forrent-post line-bottom">
                                            <div class="post-content"><a class="news-post-image-link"
                                                    href="{{ route('site.article.detail', ['slug' => Str::slug($item_room->title, '-'), 'id' => $item_room->id]) }}">
                                                    <figure class="image-container">
                                                        <div class="featured-image-overlay"><span
                                                                class="featured-image-icon"><i
                                                                    class="fa fa-camera"></i></span></div><img
                                                            class="img-responsive" src="{{ $item_room->img }}"
                                                            alt="{{ $item_room->title }}" />
                                                    </figure>
                                                </a>
                                                <h3 class="post-title title"><a class="news-post-link"
                                                        href="{{ route('site.article.detail', ['slug' => Str::slug($item_room->title, '-'), 'id' => $item_room->id]) }}">{{ $item_room->title }}</a></h3>
                                                <div class="row">
                                                    <div class="col rent-attribute"><strong>Giá :</strong><span> @if($item_room->price) {{ $item_room->price }} @else '--' @endif
                                                            triệu</span></div>
                                                    <div class="col rent-attribute"><strong>Diện tích :</strong><span> @if($item_room->acreage) {{ $item_room->acreage }} @else '--' @endif
                                                            m²</span></div>
                                                    <div class="col rent-attribute"><strong>Quận/huyện :</strong><span> @if($item_room->district_id) {{ $item_room->district->name }} @else '--' @endif</span></div>
                                                </div>
                                                <div class="post-meta-container"><span class="post-meta-item"><i
                                                            class="far fa-clock"></i> {{ $item_room->created_at->diffForHumans() }}</span><span
                                                        class="post-meta-item"><i class="fa fa-user-check"></i><a
                                                            href="javascript:void(0)"> {{ $item_room->admin_name_c }} </a></span></div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="forrent-post line-bottom">
                                        <span>Không có bài viết</span>
                                    </div>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="block">
                                <div class="block-title">
                                    <div class="module-title solid-color"><a href="#">Đô thị</a></div>
                                    @if (count($list_article_projects) > 0)
                                        @foreach ($list_article_projects as $key_project=>$item_project)
                                            <div class="news-post line-bottom small-post"><a class="news-post-image-link"
                                                    href="{{ route('site.article.detail', ['slug' => Str::slug($item_project->title, '-'), 'id' => $item_project->id]) }}">
                                                    <figure class="image-container">
                                                        <div class="featured-image-overlay"><span class="featured-image-icon"><i
                                                                    class="fa fa-camera"></i></span></div><img
                                                            class="img-responsive" src="{{ $item_project->img }}"
                                                            alt="{{ $item_project->title }}" />
                                                    </figure>
                                                </a>
                                                <div class="news-post-content">
                                                    <h3 class="post-title title"><a class="news-post-link"
                                                            href="{{ route('site.article.detail', ['slug' => Str::slug($item_project->title, '-'), 'id' => $item_project->id]) }}">{{ $item_project->title }}</a>
                                                    </h3>
                                                    <div class="post-meta-container"><span class="post-meta-item"><i
                                                                class="far fa-clock"></i> {{ $item_project->created_at->diffForHumans() }}</span></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="news-post line-bottom small-post">
                                            <span>Không có bài viết</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="block">
                                <div class="block-title">
                                    <div class="module-title solid-color"><a href="#">Cách tính thuế đất</a></div>
                                    @if (count($list_article_tax) > 0)
                                        @foreach ($list_article_tax as $key_tax=>$item_tax)
                                            <div class="news-post line-bottom small-post"><a class="news-post-image-link"
                                                    href="{{ route('site.article.detail', ['slug' => Str::slug($item_tax->title, '-'), 'id' => $item_tax->id]) }}">
                                                    <figure class="image-container">
                                                        <div class="featured-image-overlay"><span class="featured-image-icon"><i
                                                                    class="fa fa-camera"></i></span></div><img
                                                            class="img-responsive" src="{{ $item_tax->img }}"
                                                            alt="{{ $item_tax->title }}" />
                                                    </figure>
                                                </a>
                                                <div class="news-post-content">
                                                    <h3 class="post-title title"><a class="news-post-link"
                                                            href="{{ route('site.article.detail', ['slug' => Str::slug($item_tax->title, '-'), 'id' => $item_tax->id]) }}">{{ $item_tax->title }}</a>
                                                    </h3>
                                                    <div class="post-meta-container"><span class="post-meta-item"><i
                                                                class="far fa-clock"></i> {{ $item_tax->created_at->diffForHumans() }}</span></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="news-post line-bottom small-post">
                                            <span>Không có bài viết</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 sidebar">
                    @widget('recent_news')
                </div>
            </div>
        </div>
    </div>
    <div class="section-partners">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-sm-12"><br>
                    @if (count($exchangePartner) > 0)
                    <div class="partners">
                        <div class="partners-carousel owl-carousel owl-theme">
                            @foreach ($exchangePartner as $key_ex=>$item_ex)
                                <a class="partner-item" href="{{ route('site.article.detail', ['slug' => Str::slug($item_ex->title, '-'), 'id' => $item_ex->id]) }}">
                                    <img src="{{ $item_ex->img }}" alt="{{ $item_ex->title }}" />
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <br>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if count($advertise_horizontal > 0)
    <div class="section-gap banner-text"
        style="    background: #ccc url(https://syntec-numerique.fr/sites/default/files/styles/medium/public/Image/finance-syntec-02-02-2017-2.jpg?itok=sXt3wLLF) no-repeat center top / 100% 600%;">
        <div class="container">
            <div class="banner-slide">
                <div class="slide-owl-carousel owl-carousel owl-theme">
                    @foreach ($advertise_horizontal as $key_adv=>$item_adv)
                    <a href="{{ $item_adv->url }}">
                        <img src="{{ $item_adv->img}}" alt="1" style="height: 120px" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
@section('custom_js')

@endsection
